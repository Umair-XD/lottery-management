<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\TwilioService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password;
use Throwable;

class AuthController extends Controller
{
    public function __construct(protected TwilioService $twilio) {}

    /**
     * STEP 1: Register -> create user + return temp registration token (ability: registration)
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
            // mobile can be supplied here or later via /mobile
            'mobile'   => ['nullable', 'string', 'max:20'],
        ]);

        try {
            return DB::transaction(function () use ($data) {
                $user = User::create([
                    'name'     => $data['name'],
                    'email'    => $data['email'],
                    'password' => Hash::make($data['password']),
                    'mobile'   => $data['mobile'] ?? null,
                ]);

                // temp registration token with ability 'registration'
                $tempToken = $user->createToken('registration')->plainTextToken;

                Log::info('User registered', [
                    'user_id' => $user->id,
                    'email'   => $user->email,
                    'mobile'  => $user->mobile ? substr($user->mobile, 0, 4) . '****' : null,
                ]);

                return response()->json([
                    'message'     => 'Account created. Please verify your mobile number to continue.',
                    'temp_token'  => $tempToken,
                    'next_action' => 'submit_mobile',
                ], 201);
            });
        } catch (Throwable $e) {
            Log::error('Registration failed', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Registration failed. Please try again.'], 500);
        }
    }

    /**
     * FINAL LOGIN: email/password → returns long-lived token (if mobile verified).
     * If mobile NOT verified, returns temp registration token so client can verify mobile.
     */
    public function login(Request $request): JsonResponse
    {
        $creds = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $creds['email'])->first();

        if (! $user) {
            throw ValidationException::withMessages([
                'email' => ['This email is not registered.'],
            ]);
        }

        if (! Hash::check($creds['password'], $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['Incorrect password.'],
            ]);
        }

        // if mobile not verified -> issue a temp token so client can call /mobile (send/verify)
        if (is_null($user->mobile_verified_at)) {
            // create temp token (registration)
            $tempToken = $user->createToken('registration')->plainTextToken;

            return response()->json([
                'message'     => 'Mobile number not verified.',
                'next_action' => 'submit_mobile',
                'temp_token'  => $tempToken,
            ], 423);
        }

        // mobile verified -> issue final token
        $token = $user->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'user'         => $user->only('id', 'name', 'email', 'mobile'),
        ]);
    }

    /**
     * Revoke current token (temp or long-lived)
     */
    public function logout(Request $request): JsonResponse
    {
        try {
            $user = $request->user();
            $current = $user?->currentAccessToken();

            // Preferred: token is the PersonalAccessToken model instance
            if ($current instanceof PersonalAccessToken) {
                $current->delete();
            } elseif ($current && isset($current->id) && $user) {
                // Fallback: delete via relation (covers edge-cases and silences analyzer)
                $user->tokens()->where('id', $current->id)->delete();
            }

            Log::info('User logged out', [
                'user_id' => $user?->id,
            ]);

            return response()->json(['message' => 'Logged out successfully.']);
        } catch (Throwable $e) {
            Log::error('Logout failed', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Logout failed.'], 500);
        }
    }


    /**
     * Public: Send password reset OTP to verified mobile (no auth required).
     */
    public function sendResetOtp(Request $request): JsonResponse
    {
        $request->validate([
            'mobile' => ['required', 'regex:/^(0|\+92|92|3)[0-9]{9,10}$/', 'max:20'],
        ]);

        $raw  = preg_replace('/\D+/', '', $request->mobile);
        $e164 = '+92' . ltrim($raw, '0');

        if (! preg_match('/^\+92[0-9]{10}$/', $e164)) {
            return response()->json(['message' => 'Please enter a valid Pakistan mobile number.'], 422);
        }

        $user = User::where('mobile', $e164)
            ->whereNotNull('mobile_verified_at')
            ->first();

        if (! $user) {
            return response()->json(['message' => 'No verified account found with that number.'], 404);
        }

        try {
            $code = random_int(100000, 999999);

            DB::transaction(function () use ($user, $code, $e164) {
                $user->update([
                    'password_reset_code'       => (string) $code,
                    'password_reset_expires_at' => now()->addMinutes(5),
                ]);

                // Twilio send; TwilioService throws on failure -> transaction will rollback
                $this->twilio->sendOtp($e164, $code);
            });

            if (app()->environment('local', 'staging')) {
                Log::info("Password reset OTP generated", ['mobile' => substr($e164, 0, 4) . '****']);
            }

            return response()->json(['message' => "Password reset OTP sent to {$e164}."]);
        } catch (Throwable $e) {
            Log::error('OTP sending failed', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to send OTP. Please try again later.'], 500);
        }
    }

    /**
     * Public: Verify OTP and reset password.
     */
    public function resetPassword(Request $request): JsonResponse
    {
        $request->validate([
            'mobile'   => ['required', 'regex:/^(0|\+92|92|3)[0-9]{9,10}$/', 'max:20'],
            'otp'      => ['required', 'digits:6'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $raw  = preg_replace('/\D+/', '', $request->mobile);
        $e164 = '+92' . ltrim($raw, '0');

        $user = User::where('mobile', $e164)->first();

        if (
            ! $user ||
            $user->password_reset_code !== $request->otp ||
            $user->password_reset_expires_at?->isPast()
        ) {
            return response()->json(['message' => 'Invalid or expired OTP.'], 422);
        }

        try {
            DB::transaction(function () use ($user, $request) {
                // Revoke all tokens for security
                $user->tokens()->delete();

                $user->update([
                    'password'                  => Hash::make($request->password),
                    'password_reset_code'       => null,
                    'password_reset_expires_at' => null,
                ]);
            });

            return response()->json([
                'message'     => 'Password has been reset successfully.',
                'next_action' => 'login_again',
            ]);
        } catch (Throwable $e) {
            Log::error('Password reset failed', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Password reset failed. Please try again later.'], 500);
        }
    }


    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'string'],
            'password'         => ['required', 'string', 'confirmed', 'min:8'],
        ]);

        $user = $request->user();

        if (! Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The current password is incorrect.'],
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'Password updated successfully.',
        ]);
    }


    public function updateProfile(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name'   => ['sometimes', 'string', 'max:255'],
            'mobile' => ['sometimes', 'regex:/^(0|\+92|92|3)[0-9]{9,10}$/', 'unique:users,mobile,' . $user->id],
            'email'  => ['sometimes', 'email', 'unique:users,email,' . $user->id],
        ]);

        $user->update($data);

        return response()->json([
            'message' => 'Profile updated successfully.',
            'user'    => $user->only('id', 'name', 'email', 'mobile'),
        ]);
    }
}

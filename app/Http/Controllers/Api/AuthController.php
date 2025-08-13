<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\TwilioService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    public function __construct(protected TwilioService $twilio) {}

    /**
     * STEP 1: Register with name/email/password → returns a temporary token
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', Rule::unique('users')],
            'password' => ['required', 'confirmed', Password::defaults()],
            'confirm_password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $tempToken = $user
            ->createToken('registration')
            ->plainTextToken;

        return response()->json([
            'message'     => 'Account created. Please verify your mobile number to continue.',
            'temp_token'  => $tempToken,
            'next_action' => 'submit_mobile',
        ], 201);
    }

    /**
     * FINAL LOGIN: email/password → returns long‐lived token
     */
    public function login(Request $request): JsonResponse
    {
        $creds = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $creds['email'])->first();

        if (! $user || ! Hash::check($creds['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials.'],
            ]);
        }

        if (is_null($user->mobile_verified_at)) {
            return response()->json([
                'message' => 'Mobile number not verified.',
                'next_action' => 'submit_mobile',
            ], 423);
        }

        $token = $user->createToken('mobile-app')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'user'         => $user->only('id', 'name', 'email', 'mobile'),
        ]);
    }

    /**
     * Revoke the current token (temp or long-lived)
     */
    public function logout(Request $request): JsonResponse
    {
        /** @var PersonalAccessToken|null $token */
        $token = $request->user()?->currentAccessToken();

        if ($token) {
            $token->delete();
        }

        return response()->json([
            'message' => 'Logged out successfully.',
        ]);
    }

    /**
     * STEP A: Send password reset OTP to verified mobile number
     */
    public function sendResetOtp(Request $request): JsonResponse
    {
        $request->validate([
            'mobile' => ['required', 'string', 'max:20'],
        ]);

        $raw  = preg_replace('/\D+/', '', $request->mobile);
        $e164 = '+92' . ltrim($raw, '0');

        if (! preg_match('/^\+92[0-9]{10}$/', $e164)) {
            return response()->json([
                'message' => 'Please enter a valid Pakistan mobile number.',
            ], 422);
        }

        // Throttle OTP requests (1 request per minute per number)
        $executed = RateLimiter::attempt(
            'otp-request:' . $e164,
            $perMinute = 1,
            fn () => true
        );

        if (! $executed) {
            return response()->json([
                'message' => 'Too many OTP requests. Try again in a minute.',
            ], 429);
        }

        $user = User::where('mobile', $e164)
            ->whereNotNull('mobile_verified_at')
            ->first();

        if (! $user) {
            return response()->json([
                'message' => 'No verified account found with that number.',
            ], 404);
        }

        $code = random_int(100000, 999999);

        $user->update([
            'password_reset_code'       => (string) $code,
            'password_reset_expires_at' => now()->addMinutes(10),
        ]);

        // Send OTP via Twilio
        $this->twilio->sendOtp($e164, $code);

        // Log OTP only in non-production
        if (app()->environment('local', 'staging')) {
            Log::info("OTP sent to {$e164}: {$code}");
        }

        return response()->json([
            'message' => "Password reset OTP sent to {$e164}.",
        ]);
    }

    /**
     * STEP B: Verify OTP and reset password
     */
    public function resetPassword(Request $request): JsonResponse
    {
        $request->validate([
            'mobile'   => ['required', 'string', 'max:20'],
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
            return response()->json([
                'message' => 'Invalid or expired OTP.',
            ], 422);
        }

        // Revoke all tokens after reset for security
        $user->tokens()->delete();

        $user->update([
            'password'                  => Hash::make($request->password),
            'password_reset_code'       => null,
            'password_reset_expires_at' => null,
        ]);

        return response()->json([
            'message' => 'Password has been reset successfully.',
            'next_action' => 'login_again',
        ]);
    }
}

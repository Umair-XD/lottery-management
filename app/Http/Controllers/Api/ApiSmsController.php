<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Laravel\Sanctum\PersonalAccessToken;
use App\Services\TwilioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Throwable;

class ApiSmsController extends Controller
{
    public function __construct(protected TwilioService $twilio) {}

    /**
     * Send OTP to user — requires auth:sanctum
     * Accept tokens with ability 'registration' OR 'mobile-app'
     */
    public function sendOtp(Request $request)
    {
        $request->validate(['mobile' => ['nullable', 'string', 'max:20']]);

        $user = $request->user();
        if (! $user) {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }

        // must be a registration token (temp) or already mobile-app
        $canRegistration = method_exists($request->user(), 'tokenCan') && $request->user()->tokenCan('registration');
        $canMobileApp    = method_exists($request->user(), 'tokenCan') && $request->user()->tokenCan('mobile-app');

        if (! ($canRegistration || $canMobileApp)) {
            return response()->json(['message' => 'Forbidden. Invalid token for this action.'], 403);
        }

        // normalize incoming mobile if provided; otherwise use existing user's mobile
        $raw = $request->input('mobile') ?? $user->mobile;
        $raw = preg_replace('/\D+/', '', $raw);
        $e164 = null;
        if ($raw !== '') {
            if (str_starts_with($raw, '0')) {
                $e164 = '+92' . substr($raw, 1);
            } elseif (str_starts_with($raw, '92') && strlen($raw) >= 11) {
                $e164 = '+' . $raw;
            } elseif (str_starts_with($raw, '3') && strlen($raw) === 10) {
                $e164 = '+92' . $raw;
            }
        }

        if (! $e164 || ! preg_match('/^\+92[0-9]{10}$/', $e164)) {
            return response()->json(['message' => 'Please enter a valid Pakistan mobile number.'], 422);
        }

        try {
            $code = random_int(100000, 999999);

            DB::transaction(function () use ($user, $e164, $code) {
                $user->mobile = $e164;
                $user->sms_verification_code = (string) $code;
                $user->sms_code_expires_at = Carbon::now()->addMinutes(5);
                $user->save();

                // Twilio send; will throw on failure so transaction rolls back
                $this->twilio->sendOtp($e164, $code);
            });

            if (app()->environment('local', 'staging')) {
                Log::info('OTP sent for mobile verification', [
                    'user_id' => $user->id,
                    'mobile'  => substr($e164, 0, 4) . '****',
                ]);
            }

            return response()->json([
                'message' => "OTP sent to {$e164}.",
                'next_action' => 'verify_otp',
            ], 200);
        } catch (Throwable $e) {
            Log::error('Failed to send OTP', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'Failed to send OTP. Please try again.'], 500);
        }
    }

    /**
     * Verify OTP — requires auth:sanctum
     * Accept tokens with ability 'registration' OR 'mobile-app'
     * On success: mark mobile_verified_at, remove SMS code, revoke temp token (if used) and issue a new long-lived token
     */
    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        $user = $request->user();
        if (! $user) {
            return response()->json(['message' => 'Unauthorized.'], 401);
        }

        $canRegistration = method_exists($request->user(), 'tokenCan') && $request->user()->tokenCan('registration');
        $canMobileApp    = method_exists($request->user(), 'tokenCan') && $request->user()->tokenCan('mobile-app');

        if (! ($canRegistration || $canMobileApp)) {
            return response()->json(['message' => 'Forbidden. Invalid token for this action.'], 403);
        }

        if (! ($user->sms_verification_code && $user->sms_code_expires_at)) {
            return response()->json(['message' => 'No verification code found. Please request a new one.'], 422);
        }

        if ($user->sms_verification_code !== $request->otp || $user->sms_code_expires_at->isPast()) {
            return response()->json(['message' => 'Invalid or expired code.'], 422);
        }

        try {
            $newTokenPlain = null;

            DB::transaction(function () use ($user, &$newTokenPlain) {
                // mark verified and clear code
                $user->mobile_verified_at    = now();
                $user->sms_verification_code = null;
                $user->sms_code_expires_at   = null;
                $user->save();

                // Grab the current access token (if any)
                $current = $user->currentAccessToken();

                // --- SAFE DELETION: check instance so static analyzers and runtime are happy ---
                if ($current instanceof PersonalAccessToken) {
                    // abilities is usually an array on the token model
                    $abilities = $current->abilities ?? [];
                    if (in_array('registration', $abilities, true)) {
                        $current->delete();
                    }
                } elseif ($current && isset($current->id)) {
                    // Fallback: delete via relation (covers edgecases)
                    $user->tokens()->where('id', $current->id)->delete();
                }

                // Issue final token
                $newTokenPlain = $user->createToken('mobile-app')->plainTextToken;
            });

            return response()->json([
                'message'      => 'Phone number verified!',
                'access_token' => $newTokenPlain,
                'token_type'   => 'Bearer',
            ], 200);
        } catch (Throwable $e) {
            Log::error('OTP verification failed', ['error' => $e->getMessage()]);
            return response()->json(['message' => 'OTP verification failed. Please try again.'], 500);
        }
    }
}

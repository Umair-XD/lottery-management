<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TwilioService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ApiSmsController extends Controller
{
    protected TwilioService $twilio;

    public function __construct(TwilioService $twilio)
    {
        $this->twilio = $twilio;
    }

    // Handle the “Send OTP” action
    public function sendOtp(Request $request)
    {
        $request->validate([
            'mobile' => ['required', 'string', 'max:20'],
        ]);

        $raw = preg_replace('/\D+/', '', $request->input('mobile'));
        $e164 = null;

        if (str_starts_with($raw, '0')) {
            // strip leading zero, prefix +92
            $e164 = '+92' . substr($raw, 1);
        } elseif (str_starts_with($raw, '92')) {
            // prefix +
            $e164 = '+' . $raw;
        } elseif (str_starts_with($raw, '923') && strlen($raw) === 12) {
            // already country code without plus
            $e164 = '+' . $raw;
        } elseif (str_starts_with($raw, '9') || str_starts_with($raw, '3')) {
            // local mobile missing leading zero, e.g. "3012345678"
            $e164 = '+92' . $raw;
        } elseif (str_starts_with($raw, '92') && strlen($raw) < 12) {
            // malformed but try prefix
            $e164 = '+' . $raw;
        }

        // final check
        if (! $e164 || ! preg_match('/^\+92[0-9]{10}$/', $e164)) {
            return back()
                ->withInput()
                ->withErrors(['mobile' => 'Please enter a valid Pakistan mobile number.']);
        }

        $user = Auth::user();
        $user->mobile = $e164;

        $code = random_int(100000, 999999);
        $user->sms_verification_code = (string)$code;
        $user->sms_code_expires_at   = Carbon::now()->addMinutes(5);
        $user->save();

        $this->twilio->sendOtp($e164, $code);

        return response()->json([
            'message'     => "OTP sent to {$e164}",
            'next_action' => 'verify_otp'
        ], 200);
    }

    // Verify the submitted OTP
    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        $user = Auth::user();

        if (
            $user->sms_verification_code === $request->otp &&
            $user->sms_code_expires_at?->isFuture()
        ) {
            $user->mobile_verified_at    = now();
            $user->sms_verification_code = null;
            $user->sms_code_expires_at   = null;
            $user->save();

            return response()->json([
                'message' => 'Phone number verified!'
            ], 200);
        }

        return response()->json([
            'message' => 'Invalid or expired code.'
        ], 422);
    }
}

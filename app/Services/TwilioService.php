<?php

namespace App\Services;

use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class TwilioService
{
    protected Client $client;
    protected string $messagingServiceSid;

    public function __construct()
    {
        $this->client = new Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );
        $this->messagingServiceSid = config('services.twilio.messaging_service_sid');
    }

    /**
     * Send SMS (generic) or OTP via options
     *
     * @param string $to      E.164 formatted number (e.g. '+923001234567')
     * @param string $body    Text body
     * @param array  $opts    Optional Twilio params:
     *                        - 'statusCallback' => URL|string
     *                        - 'validityPeriod' => int (seconds)
     *                        - etc.
     */
    public function sendSMS(string $to, string $body, array $opts = [])
    {
        $params = array_merge([
            'messagingServiceSid' => $this->messagingServiceSid,
            'body'                => $body,
        ], $opts);

        try {
            return $this->client->messages->create($to, $params);
        } catch (\Exception $e) {
            Log::error('Twilio SMS send failed: '.$e->getMessage(), compact('to','body','opts'));
            throw $e;
        }
    }

    /**
     * Shortcut for OTPs: sets a 6-digit body, TTL and callback
     */
    public function sendOtp(string $to, string $code, int $ttl = 300)
    {
        return $this->sendSMS(
            $to,
            "Your verification code is {$code}",
            [
                'statusCallback' => route('twilio.callback'),
                'validityPeriod' => $ttl,
            ]
        );
    }
}

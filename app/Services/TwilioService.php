<?php

namespace App\Services;

use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;
use RuntimeException;
use Throwable;

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
     * Send SMS message
     *
     * @throws RuntimeException if Twilio fails
     */
    public function sendSMS(string $to, string $body, array $opts = [])
    {
        $params = array_merge([
            'messagingServiceSid' => $this->messagingServiceSid,
            'body'                => $body,
        ], $opts);

        try {
            return $this->client->messages->create($to, $params);
        } catch (Throwable $e) {
            Log::error('Twilio SMS failed', [
                'to'    => $to,
                'error' => $e->getMessage(),
            ]);

            // Throw controlled exception, don’t expose Twilio internals
            throw new RuntimeException('SMS delivery failed, please try again later.');
        }
    }

    /**
     * Shortcut: OTP message
     */
    public function sendOtp(string $to, string $code, int $ttl = 300)
    {
        return $this->sendSMS(
            $to,
            "Your verification code is {$code}",
            ['validityPeriod' => $ttl]
        );
    }
}

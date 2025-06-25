<?php

namespace App\Services;

use Twilio\Rest\Client;

class TwilioService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );
    }

    public function sendSMS($to, $message)
    {
        return $this->client->messages->create(
            $to, // Include country code, e.g., +923001234567
            [
                'from' => config('services.twilio_sms.from'),
                'body' => $message,
            ]
        );
    }

    public function sendWhatsApp($to, $message)
    {
        return $this->client->messages->create(
            'whatsapp:' . $to,
            [
                'from' => config('services.twilio.from'),
                'body' => $message,
            ]
        );
    }
}

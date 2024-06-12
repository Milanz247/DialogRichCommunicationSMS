<?php

namespace YourVendor\RichCommunication\Services;

use Illuminate\Support\Facades\Http;

class RichCommunicationAPIService
{
    protected $apiUsername;
    protected $apiPassword;

    public function __construct()
    {
        $this->apiUsername = config('richcommunication.api_username');
        $this->apiPassword = config('richcommunication.api_password');
    }

    public function sendSMS($numbers, $message, $mask, $campaignName)
    {
        $url = 'https://richcommunication.dialog.lk/api/sms/send';

        $payload = [
            'messages' => [
                [
                    'number' => $numbers,
                    'mask' => $mask,
                    'text' => $message,
                    'campaignName' => $campaignName,
                ],
            ],
        ];

        return $this->sendRequest($url, $payload);
    }

    public function sendViberMessage($numbers, $image, $caption, $action, $text, $mask, $smsText, $campaignName)
    {
        $url = 'https://richcommunication.dialog.lk/api/viber/send';

        $payload = [
            'messages' => [
                [
                    'number' => $numbers,
                    'image' => $image,
                    'caption' => $caption,
                    'action' => $action,
                    'text' => $text,
                    'mask' => $mask,
                    'smsText' => $smsText,
                    'campaignName' => $campaignName,
                ],
            ],
        ];

        return $this->sendRequest($url, $payload);
    }

    protected function sendRequest($url, $payload)
    {
        try {
            date_default_timezone_set('Asia/Colombo');

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'USER' => $this->apiUsername,
                'DIGEST' => md5($this->apiPassword),
                'CREATED' => now()->format('Y-m-d\TH:i:s'),
            ])->post($url, $payload);

            return $response->json();
        } catch (\Exception $e) {
            // Handle exception (log, throw, etc.)
            return false;
        }
    }
}

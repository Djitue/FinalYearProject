<?php

namespace App\Classes;

class SendSMS
{
    public function sendSMS($msisdn, $message)
    {
        $token = $this->SMSToken();

        if (!$token) {
            return 'Failed to retrieve token.';
        }

        $payload = [
            "senderAddress" => "TRACE-AM",
            "receiverAddress" => [$msisdn],
            "message" => $message,
            "clientCorrelator" => "TRACE-AM"
        ];

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.mtn.com/v2/messages/sms/outbound',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 15,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $token,
                'Content-Type: application/json'
            ],
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);

        if ($error) {
            return 'Curl Error: ' . $error;
        }

        $data = json_decode($response, true);

        // Optional logging
        // \Log::info("SMS Sent to $msisdn", ['response' => $data]);

        return $data['statusMessage'] ?? 'Unknown error';
    }

    private function SMSToken()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.mtn.com/v1/oauth/access_token?grant_type=client_credentials',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 15,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query([
                'client_id' => env('MTN_CLIENT_ID', 'YOUR_CLIENT_ID'),
                'client_secret' => env('MTN_CLIENT_SECRET', 'YOUR_CLIENT_SECRET'),
            ]),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/x-www-form-urlencoded'
            ],
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);

        if ($error) {
            return null;
        }

        $data = json_decode($response, true);
        return $data["access_token"] ?? null;
    }
}

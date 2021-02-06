<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait SmsMarketingUAE
{
    private function buildHttpClient()
    {
        $endpoint = 'http://customers.smsmarketing.ae/app/smsapi/';
        return new Client(['base_uri' => $endpoint]);
    }

    public function sendSms($msg, $toPhone)
    {
        $normalizedPhone = substr($toPhone, 1); // remove +

        $client = $this->buildHttpClient();
        $response = $client->request('POST', 'index.php', [
            'query' => [
                'key' => "5f0f0941ed252", //API_Key
                'campaign' => "6667", //UAE
                'routeid' => "39", //default
                'type' => "text", //SMS_Type
                'contacts' => $normalizedPhone,
                'senderid' => "7891",
                'msg' => $msg,
            ]
        ]);
        $array = json_decode($response->getBody(), true);
        return $array;
    }
}

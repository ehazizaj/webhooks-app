<?php

namespace App\Handler;

use Illuminate\Support\Facades\Http;
use Spatie\WebhookClient\ProcessWebhookJob;

class ProcessWebhook extends ProcessWebhookJob
{
    public function handle()
    {
        $data = json_decode($this->webhookCall, true)['payload']['data'];
        $this->apiCallResponse($data);
        http_response_code(200);
    }


    private function apiCallResponse($data)
    {
      return Http::withBasicAuth('spp_api_quNd1EXgCWnsa9P60DHKMe8b3Tr2yLBx', 'spp_api_quNd1EXgCWnsa9P60DHKMe8b3Tr2yLBx')
            ->asForm()
            ->post("https://dev.spp.io/api/v1/order_messages/{$data['id']}", [
                'message' => '<p>This message is generated from my Laravel App</p>',
                'user_id' => $data['client']['id'],
                'staff_only' => '0',
            ]);


    }
}

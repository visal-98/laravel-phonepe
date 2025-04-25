<?php

namespace Visal\PhonePe;

use Illuminate\Support\Facades\Http;

class PhonePe
{
    protected function token(): string
    {
        $response = Http::asForm()->post(config('phonepe.base_url') . '/apis/pg-sandbox/v1/oauth/token', [
            'client_id'     => config('phonepe.client_id'),
            'client_secret' => config('phonepe.client_secret'),
            'client_version'=> config('phonepe.client_version'),
            'grant_type'    => 'client_credentials',
        ]);

        return $response->json('access_token');
    }

    public function createPaymentUrl(string $orderId, int $amount, string $redirectUrl = null): array
    {
        $token = $this->token();

        $response = Http::withHeaders([
            'Authorization' => 'O-Bearer ' . $token,
            'Content-Type'  => 'application/json',
        ])->post(config('phonepe.base_url') . '/apis/pg-sandbox/checkout/v2/pay', [
            'merchantOrderId' => $orderId,
            'amount'          => $amount,
            'expireAfter'     => 1200,
            'metaInfo'        => ['udf1' => 'demo'],
            'paymentFlow'     => [
                'type' => 'PG_CHECKOUT',
                'merchantUrls' => [
                    'redirectUrl' => $redirectUrl ?? url(config('phonepe.redirect_success')),
                ],
            ],
        ]);

        return $response->json();
    }

    public function checkStatus(string $orderId): array
    {
        $token = $this->token();
        $url = config('phonepe.base_url') . "/apis/pg-sandbox/checkout/v2/order/{$orderId}/status";

        return Http::withHeaders([
            'Authorization' => 'O-Bearer ' . $token,
            'Content-Type'  => 'application/json',
        ])->get($url)->json();
    }

    public function refund(string $refundId, string $orderId, int $amount): array
    {
        $token = $this->token();

        return Http::withHeaders([
            'Authorization' => 'O-Bearer ' . $token,
            'Content-Type'  => 'application/json',
        ])->post(config('phonepe.base_url') . "/apis/pg-sandbox/payments/v2/refund", [
            'merchantRefundId' => $refundId,
            'originalMerchantOrderId' => $orderId,
            'amount' => $amount,
        ])->json();
    }

    public function refundStatus(string $refundId): array
    {
        $token = $this->token();

        return Http::withHeaders([
            'Authorization' => 'O-Bearer ' . $token,
            'Content-Type'  => 'application/json',
        ])->get(config('phonepe.base_url') . "/apis/pg-sandbox/payments/v2/refund/{$refundId}/status")->json();
    }
}

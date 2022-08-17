<?php

namespace Liquido\PayIn\Api;

use \Magento\Framework\HTTP\Client\Curl;
use \Liquido\PayIn\Helper\Data;
// use Magento\Framework\Math\Random;

class LiquidoPixClient
{

    private const PIX_ENDPOINT = "/v1/payments/charges/pix";

    protected $curl;
    protected $liquidoConfig;

    private $liquidoAccessToken;

    // public function __construct(
    //     Curl $_curl
    // ) {
    //     $this->curl = $_curl;
    //     $this->curl->addHeader("Content-Type", "application/json");
    //     $this->curl->addHeader("x-api-key", LiquidoPixClient::API_KEY);
    //     $this->curl->addHeader("Authorization", "Bearer <access_token>");
    // }

    public function __construct()
    {
        $this->curl = new Curl;
        $this->curl->addHeader("Content-Type", "application/json");

        $this->liquidoConfig = new Data;
        $this->curl->addHeader("x-api-key", $this->liquidoConfig->getApiKey());

        $liquidoAuthClient = new LiquidoAuthClient;
        $authJsonResponse = $liquidoAuthClient->authenticate();
        $authResponse = json_decode($authJsonResponse);
        $this->liquidoAccessToken = $authResponse->access_token;
    }

    public function createPixPayIn($incrementId, $customerEmail, $amountTotal, $callbackUrl)
    {

        $this->curl->addHeader("Authorization", "Bearer $this->liquidoAccessToken");

        $url = $this->liquidoConfig->getVirgoBaseUrl() . $this::PIX_ENDPOINT;

        // $mathRandom = new Random;
        // $idempotencyKey = $mathRandom->getUniqueHash();

        $data = [
            "idempotencyKey" => $incrementId,
            "amount" => $amountTotal,
            "currency" => "BRL",
            "country" => "BR",
            "paymentMethod" => "PIX_STATIC_QR",
            "paymentFlow" => "DIRECT",
            "callbackUrl" => $callbackUrl,
            "payer" => [
                "email" => $customerEmail
            ]
        ];

        $jsonData = json_encode($data);

        try {
            $this->curl->post($url, $jsonData);
            $result = $this->curl->getBody();
            return $result;
        } catch (\Exception $e) {
            echo $e;
        }
    }
}

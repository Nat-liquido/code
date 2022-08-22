<?php

namespace Liquido\PayIn\Api;

use \Magento\Framework\HTTP\Client\Curl;
use \Liquido\PayIn\Helper\Data;
// use Magento\Framework\Math\Random;

class LiquidoBoletoClient
{

    private const BOLETO_ENDPOINT = "/v1/payments/charges/boleto";

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

    public function createBoletoPayIn($incrementId, $customerEmail, $amountTotal, $callbackUrl)
    {

        $this->curl->addHeader("Authorization", "Bearer $this->liquidoAccessToken");

        $url = $this->liquidoConfig->getVirgoBaseUrl() . $this::BOLETO_ENDPOINT;

        // $mathRandom = new Random;
        // $idempotencyKey = $mathRandom->getUniqueHash();

        $data = [
            "idempotencyKey" => $incrementId,
            "amount" => $amountTotal,
            "currency" => "BRL",
            "country" => "BR",
            "paymentMethod" => "BOLETO",
            "paymentFlow" => "DIRECT",
            "callbackUrl" => $callbackUrl,
            "payer" => [
                "name" => "AAAAAAAAAAAAAAAA",
                "document" => [
                    "documentId" => "80313612234",
                    "type" => "CPF"
                ],
                "billingAddress" => [
                    "zipCode" => "01423001",
                    "state" => "SP",
                    "city" => "sao paulo",
                    "district" => "Jardim Paulista",
                    "street" => "Rua Jose Maria Lisboa",
                    "number" => "313",
                    "complement" => "ap 161",
                    "country" => "BR"
                ],
                // "email" => $customerEmail
            ],
            "paymentTerm" => [
                "paymentDeadline" => 1661920576
            ],
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

<?php

namespace Liquido\PayIn\Api;

use \Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Math\Random;

class LiquidoPixClient
{

    private const BASE_URL = "https://api-qa.liquido.com";
    private const PIX_ENDPOINT = "/v1/payments/charges/pix";
    private const API_KEY = "fztXT5QuK755svjly94H6anwAYD1Ap3249jH2djb";

    protected $curl;

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
        $this->curl->addHeader("x-api-key", LiquidoPixClient::API_KEY);
    }

    public function createPixPayIn($accessToken)
    {

        $this->curl->addHeader("Authorization", "Bearer $accessToken");

        $url = $this::BASE_URL . $this::PIX_ENDPOINT;

        $mathRandom = new Random;

        $idempotencyKey = $mathRandom->getUniqueHash();

        $jsonData = <<<HEREA
        {
            "idempotencyKey": "$idempotencyKey",
            "amount": 128,
            "currency": "BRL",
            "country": "BR",
            "paymentMethod": "PIX_STATIC_QR",
            "paymentFlow": "DIRECT",
            "payer": {

            }
        }
        HEREA;

        // echo $url . " - ";
        // echo $jsonData . " - ";

        try {
            $this->curl->post($url, $jsonData);
            $result = $this->curl->getBody();
            return $result;
        } catch (\Exception $e) {
            // TO DO something...
        }
    }
}

<?php

namespace Liquido\PayIn\Api;

use \Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Math\Random;

class LiquidoPixClient
{

    private const BASE_URL = "https://api-qa.liquido.com";
    private const PIX_ENDPOINT = "/v1/payments/charges/pix";

    protected $curl;

    // public function __construct(
    //     Curl $_curl
    // ) {
    //     $this->curl = $_curl;
    //     $this->curl->addHeader("Content-Type", "application/json");
    //     $this->curl->addHeader("x-api-key", "fztXT5QuK755svjly94H6anwAYD1Ap3249jH2djb");
    //     $this->curl->addHeader("Authorization", "Bearer <access_token>");
    // }

    public function __construct()
    {
        $this->curl = new Curl;
        $this->curl->addHeader("Content-Type", "application/json");
        $this->curl->addHeader("x-api-key", "fztXT5QuK755svjly94H6anwAYD1Ap3249jH2djb");
        $this->curl->addHeader("Authorization", "Bearer eyJraWQiOiI3V09TVjlRMUZLVnVkOFUxR0pMTFZhVEdrOTg2YVR5S0VUbzl6VXF6MGJZPSIsImFsZyI6IlJTMjU2In0.eyJzdWIiOiI1ZDY0ODE1YTBpNjNuNHZ1bzRoYWt0bGIzYSIsInRva2VuX3VzZSI6ImFjY2VzcyIsInNjb3BlIjoiaHR0cHM6XC9cL2FwaS1xYS5saXF1aWRvLmNvbVwvdjFcL3BheW1lbnRzXC9wYXlvdXRzXC9BTEwgaHR0cHM6XC9cL2FwaS1xYS5saXF1aWRvLmNvbVwvdjFcL3BheW1lbnRzXC9jaGFyZ2VzXC9BTEwiLCJhdXRoX3RpbWUiOjE2NTk2NDQ4OTIsImlzcyI6Imh0dHBzOlwvXC9jb2duaXRvLWlkcC5hcC1zb3V0aGVhc3QtMS5hbWF6b25hd3MuY29tXC9hcC1zb3V0aGVhc3QtMV9qc1NCVzlRYkwiLCJleHAiOjE2NTk2NDg0OTIsImlhdCI6MTY1OTY0NDg5MiwidmVyc2lvbiI6MiwianRpIjoiMTNkYmViODAtOTU4YS00MGFlLTgyYjQtZWJkYmJiOGFmZjM5IiwiY2xpZW50X2lkIjoiNWQ2NDgxNWEwaTYzbjR2dW80aGFrdGxiM2EifQ.rtrifYYWc_954lum7yJBGacI8GnzsyYofvhSU0aQQnE76IF_KzxDOdG1q4BQtL8UZxMMTcTgk060eS7ZGgcd9zT-70zwKzwVa5nulCov978KEBwUA9wlcG_0Dc4RJzeA1R3Eb45jUFZBhJ46qg5PNUdVffl7ipqP2UjQhoURk7htLyDT3JpG_9re0Bkz4yJl91i4Ac5xzWtKDbhQRxRxNt-PkFb5prEcLrrbL17t-Em7NVW6N0FHVf5072c-Kpo3iOV__6Jsux9Mto1oflcoY06L1XRE270PmU86SmqqKhe0o2EoohT97YHiTQ9FSgCcpN9hNfJLQZRY7Sv7t4vEnA");
    }

    public function createPixPayIn()
    {
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

        echo $url . " - ";
        echo $jsonData . " - ";

        try {
            $this->curl->post($url, $jsonData);
            $result = $this->curl->getBody();
            return $result;
        } catch (\Exception $e) {
            // TO DO something...
        }
    }
}

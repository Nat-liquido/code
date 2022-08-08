<?php

namespace Liquido\PayIn\Api;

use \Magento\Framework\HTTP\Client\Curl;

class LiquidoAuthClient
{

    private const AUTH_URL = "https://auth-dev.liquido.com/oauth2/token";
    private const CLIENT_ID = "5d64815a0i63n4vuo4haktlb3a";
    private const CLIENT_SECRET = "1dkbocf1bojiefu2akfmnv5dd9evhmqtc833i62c7q3u8flvbt4o";
    private const GRANT_TYPE = "client_credentials";

    protected $curl;

    // public function __construct(
    //     Curl $_curl
    // ) {
    //     $this->curl = $_curl;
    //     $this->curl->addHeader("Content-Type", "application/x-www-form-urlencoded");
    // }

    public function __construct()
    {
        $this->curl = new Curl;
        $this->curl->addHeader("Content-Type", "application/x-www-form-urlencoded");
    }

    public function authenticate()
    {

        $form = [
            "client_id" => LiquidoAuthClient::CLIENT_ID,
            "client_secret" => LiquidoAuthClient::CLIENT_SECRET,
            "grant_type" => LiquidoAuthClient::GRANT_TYPE,
        ];

        try {
            $this->curl->post(LiquidoAuthClient::AUTH_URL, $form);
            $result = $this->curl->getBody();
            return $result;
        } catch (\Exception $e) {
            echo $e;
        }
    }
}

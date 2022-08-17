<?php

namespace Liquido\PayIn\Api;

use \Magento\Framework\HTTP\Client\Curl;
use \Liquido\PayIn\Helper\Data;

class LiquidoAuthClient
{

    private const AUTH_URL = "https://auth-dev.liquido.com/oauth2/token";
    private const GRANT_TYPE = "client_credentials";

    protected $curl;
    protected $formData;

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
        $liquidoConfig = new Data;
        $this->formData = [
            "client_id" => $liquidoConfig->getClientId(),
            "client_secret" => $liquidoConfig->getClientSecret(),
            "grant_type" => LiquidoAuthClient::GRANT_TYPE,
        ];
    }

    public function authenticate()
    {

        try {
            $this->curl->post(LiquidoAuthClient::AUTH_URL, $this->formData);
            $result = $this->curl->getBody();
            return $result;
        } catch (\Exception $e) {
            echo $e;
        }
    }
}

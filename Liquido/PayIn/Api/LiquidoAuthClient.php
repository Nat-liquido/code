<?php

namespace Liquido\PayIn\Api;

use \Magento\Framework\HTTP\Client\Curl;
use \Liquido\PayIn\Helper\Data;

class LiquidoAuthClient
{

    private const GRANT_TYPE = "client_credentials";

    protected $curl;
    protected $formData;
    protected $liquidoConfig;

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
        $this->liquidoConfig = new Data;
        $this->formData = [
            "client_id" => $this->liquidoConfig->getClientId(),
            "client_secret" => $this->liquidoConfig->getClientSecret(),
            "grant_type" => LiquidoAuthClient::GRANT_TYPE,
        ];
    }

    public function authenticate()
    {

        try {
            $this->curl->post($this->liquidoConfig->getAuthUrl(), $this->formData);
            $result = $this->curl->getBody();
            return $result;
        } catch (\Exception $e) {
            echo $e;
        }
    }
}

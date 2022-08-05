<?php

namespace Liquido\PayIn\Service;

use Liquido\PayIn\Api\LiquidoAuthClient;
use Liquido\PayIn\Api\LiquidoPixClient;

class LiquidoPixPayInService
{
    private $accessToken;

    public function __construct() {
        $liquidoAuthClient = new LiquidoAuthClient;
        $authJsonResponse = $liquidoAuthClient->authenticate();
        $authResponse = json_decode($authJsonResponse);
        $this->accessToken = $authResponse->access_token;
    }

    public function createLiquidoPixPayIn()
    {
        try {
            $liquidoPixPayInClient = new LiquidoPixClient;
            $pixJsonResponse = $liquidoPixPayInClient->createPixPayIn($this->accessToken);
            $pixResponse = json_decode($pixJsonResponse);
            return $pixResponse->qrCode;
        } catch (\Exception $e) {
            echo $e;
        }
    }
}

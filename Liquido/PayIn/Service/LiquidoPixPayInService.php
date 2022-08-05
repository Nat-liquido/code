<?php

namespace Liquido\PayIn\Service;

use Liquido\PayIn\Api\LiquidoPixClient;

class LiquidoPixPayInService
{
    public function createLiquidoPixPayIn($customerEmail)
    {
        try {
            $liquidoPixPayInClient = new LiquidoPixClient;
            $pixJsonResponse = $liquidoPixPayInClient->createPixPayIn($customerEmail);
            $pixResponse = json_decode($pixJsonResponse);
            return $pixResponse->qrCode;
        } catch (\Exception $e) {
            echo $e;
        }
    }
}

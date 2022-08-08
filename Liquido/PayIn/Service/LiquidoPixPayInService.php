<?php

namespace Liquido\PayIn\Service;

use Liquido\PayIn\Api\LiquidoPixClient;

class LiquidoPixPayInService
{
    public function createLiquidoPixPayIn($customerEmail, $amountTotal)
    {
        try {
            $liquidoPixPayInClient = new LiquidoPixClient;
            $pixJsonResponse = $liquidoPixPayInClient->createPixPayIn($customerEmail, $amountTotal);
            $pixResponse = json_decode($pixJsonResponse);
            return $pixResponse->qrCode;
        } catch (\Exception $e) {
            echo $e;
        }
    }
}

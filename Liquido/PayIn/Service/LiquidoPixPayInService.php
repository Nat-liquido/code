<?php

namespace Liquido\PayIn\Service;

use Liquido\PayIn\Api\LiquidoPixClient;

class LiquidoPixPayInService
{
    public function createLiquidoPixPayIn(
        $incrementId,
        $customerEmail,
        $amountTotal,
        $callbackUrl
    ) {
        try {
            $liquidoPixPayInClient = new LiquidoPixClient;
            $pixJsonResponse = $liquidoPixPayInClient->createPixPayIn(
                $incrementId,
                $customerEmail,
                $amountTotal,
                $callbackUrl
            );
            $pixResponse = json_decode($pixJsonResponse);
            return $pixResponse->qrCode;
        } catch (\Exception $e) {
            echo $e;
        }
    }
}

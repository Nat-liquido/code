<?php

namespace Liquido\PayIn\Service;

use Liquido\PayIn\Api\LiquidoBoletoClient;

class LiquidoBoletoPayInService
{
    public function createLiquidoBoletoPayIn(
        $incrementId,
        $customerEmail,
        $amountTotal,
        $callbackUrl
    ) {
        try {
            $liquidoBoletoPayInClient = new LiquidoBoletoClient;
            $boletoJsonResponse = $liquidoBoletoPayInClient->createBoletoPayIn(
                $incrementId,
                $customerEmail,
                $amountTotal,
                $callbackUrl
            );
            $pixResponse = json_decode($boletoJsonResponse);
            return $pixResponse->qrCode;
        } catch (\Exception $e) {
            echo $e;
        }
    }
}

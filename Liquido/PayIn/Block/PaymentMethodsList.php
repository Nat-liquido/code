<?php

namespace Liquido\PayIn\Block;

use \Magento\Framework\View\Element\Template;

class LiquidoPayInMethod {
    public const PIX = 'Pix';
    public const BOLETO = 'Boleto';
}

class LiquidoPayInViewRoute {
    public const PIX = 'pixstepone';
    public const BOLETO = '#';
}

class PaymentMethodsList extends Template
{

    public function getLiquidoBrazilPayInMethods()
    {
        $brazil_payin_methods = [LiquidoPayInMethod::PIX, LiquidoPayInMethod::BOLETO];
        return $brazil_payin_methods;
    }

    public function getPayInMethodViewRoute($_payin_method)
    {
        switch ($_payin_method) {
            case LiquidoPayInMethod::PIX:
                return LiquidoPayInViewRoute::PIX;
                break;
            case LiquidoPayInMethod::BOLETO:
                return LiquidoPayInViewRoute::BOLETO;
                break;
            default:
                return "#";
          }
    }
}

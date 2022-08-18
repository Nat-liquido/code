<?php

namespace Liquido\PayIn\Block;

use \Magento\Framework\View\Element\Template;

class LiquidoPayInMethod {
    // public const PIX = 'Pix';
    public const PIX = [
        "title" => "Pix",
        "description" => "O pagamento será aprovado na hora.",
        "image" => "Liquido_PayIn::images/pix.png"
    ];
    // public const BOLETO = 'Boleto';
    public const BOLETO = [
        "title" => "Boleto",
        "description" => "O pagamento será aprovado em até 3 dias úteis.",
        "image" => "Liquido_PayIn::images/boleto.png"
    ];
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

    public function getPayInMethodViewRoute($_payin_method_title)
    {
        switch ($_payin_method_title) {
            case LiquidoPayInMethod::PIX["title"]:
                return LiquidoPayInViewRoute::PIX;
                break;
            case LiquidoPayInMethod::BOLETO["title"]:
                return LiquidoPayInViewRoute::BOLETO;
                break;
            default:
                return "#";
          }
    }
}

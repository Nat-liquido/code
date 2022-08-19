<?php

namespace Liquido\PayIn\Block;

use \Magento\Framework\View\Element\Template;

use \Liquido\PayIn\Util\LiquidoPayInMethod;
use \Liquido\PayIn\Util\LiquidoPayInViewRoute;

class LiquidoBrlIndex extends Template
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

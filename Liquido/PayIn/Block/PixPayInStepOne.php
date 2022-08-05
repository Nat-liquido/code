<?php

namespace Liquido\PayIn\Block;

use \Magento\Framework\View\Element\Template;

class PixPayInStepOne extends Template
{
    public function getPixPayInMethodName()
    {
        // return LiquidoPayInMethod::PIX;
        return "Pix";
    }

}

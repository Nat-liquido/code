<?php

namespace Liquido\PayIn\Block;

// Template is a class from which you inherit your own block that interacts with the template
use \Magento\Framework\View\Element\Template;

class PaymentMethodsList extends Template
{

    public function getLiquidoBrazilPayInMethods()
    {
        $brazil_payin_methods = ["PIX", "Boleto", "Cartão de Crédito", "AME Digital", "PicPay", "PayPal", "Mercado Pago"];
        return $brazil_payin_methods;
    }
    
}
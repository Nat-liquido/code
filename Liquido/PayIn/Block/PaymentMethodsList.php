<?php

namespace Liquido\PayIn\Block;

// Template is a class from which you inherit your own block that interacts with the template
use \Magento\Framework\View\Element\Template;

class PaymentMethodsList extends Template
{

    public function getLiquidoBrazilPayInMethods()
    {
        $brazil_payin_methods = ["PIX", "Boleto", "Cartão de Crédito", "AME Digital", "Pic Pay", "PayPal", "Mercado Pago"];
        $html_output = "";
        foreach ($brazil_payin_methods as $payin_method) {
            $html_output .= "<li><a href='https://www.w3schools.com'>" . $payin_method ."</a></li>";
        }
        $html_output = "<ul>" . $html_output . "</ul>";
        return $html_output;
    }
    
}
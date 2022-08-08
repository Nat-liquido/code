<?php

namespace Liquido\PayIn\Block;

use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Magento\Framework\App\ObjectManager;

use \Liquido\PayIn\Service\LiquidoPixPayInService;

class PixPayInStepTwo extends Template
{

    private $pixCode = "<pix_code>";

    public function __construct(
        Context $context,
        LiquidoPixPayInService $pixPayInService,
        array $data = []
    ) {
        parent::__construct($context, $data);        
        
        $customerEmail = $this->getCustomerEmail();
        
        $amountTotal = $this->getCartAmountTotal();

        // $orderId = $this->getOrderId();
        // echo "*** orderId: $orderId";

        $this->pixCode = $pixPayInService->createLiquidoPixPayIn($customerEmail, $amountTotal);
    }

    public function getPixCode()
    {
        return $this->pixCode;
    }

    private function getCustomerEmail()
    {
        return $this->getRequest()->getParam('email_address');
    }

    private function getOrderId()
    {
        try {
            $objectManager = ObjectManager::getInstance();
            $cart = $objectManager->get('\Magento\Checkout\Model\Cart');
            return $cart->getQuote()->getId();
        } catch (\Exception $e) {
            echo $e;
            return null;
        }
    }

    private function getCartAmountTotal()
    {
        try {
            $objectManager = ObjectManager::getInstance();
            $cart = $objectManager->get('\Magento\Checkout\Model\Cart');
            return (float) $cart->getQuote()->getGrandTotal() * 100;
        } catch (\Exception $e) {
            echo $e;
            return null;
        }
    }
}

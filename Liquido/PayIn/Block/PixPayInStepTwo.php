<?php

namespace Liquido\PayIn\Block;

use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Magento\Framework\App\ObjectManager;
use \Magento\Checkout\Model\Session;

use \Liquido\PayIn\Service\LiquidoPixPayInService;

class PixPayInStepTwo extends Template
{

    private $pixCode = "<pix_code>";
    private $orderId = "<order_id>";
    private $errorMsg = null;
    protected $checkoutSession;

    public function __construct(
        Context $context,
        Session $checkoutSession,
        LiquidoPixPayInService $pixPayInService,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->checkoutSession = $checkoutSession;
        
        $customerEmail = $this->getCustomerEmail();
        
        $amountTotal = $this->getCartAmountTotal();
        if ($amountTotal == 0){
            $this->errorMsg = "O valor da compra deve ser maior que R$0,00.";
            return null;
        }

        $this->orderId = $this->reserveIncrementId();

        $this->pixCode = $pixPayInService->createLiquidoPixPayIn($this->orderId, $customerEmail, $amountTotal);
    }

    public function getPixCode()
    {
        return $this->pixCode;
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function getErrorMsg()
    {
        return $this->errorMsg;
    }

    private function getCustomerEmail()
    {
        return $this->getRequest()->getParam('email_address');
    }

    private function reserveIncrementId()
    {
        try {
            
            $this->checkoutSession->getQuote()->reserveOrderId();
            $orderId = $this->checkoutSession->getQuote()->getReservedOrderId();
            return $orderId;
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

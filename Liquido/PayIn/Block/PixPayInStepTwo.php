<?php

namespace Liquido\PayIn\Block;

use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Magento\Checkout\Model\Session;

use \Liquido\PayIn\Service\LiquidoPixPayInService;
use \Liquido\PayIn\Helper\Data;

class PixPayInStepTwo extends Template
{

    private $pixCode = "<pix_code>";
    private $orderId = "<order_id>";
    private $errorMsg = null;
    protected $checkoutSession;
    protected $orderData;
    protected $cart;

    public function __construct(
        Context $context,
        Session $checkoutSession,
        LiquidoPixPayInService $pixPayInService,
        Data $orderData,
        array $data = []
    ) {

        parent::__construct($context, $data);
        $this->checkoutSession = $checkoutSession;
        $this->orderData = $orderData;

        // init the PIX generation in Liquido Virgo API
        $this->orderId = $this->getIncrementId();
        $customerEmail = $this->getCustomerEmail();
        $grandTotal = $this->getGrandTotal($this->orderId);
        if ($grandTotal == 0) {
            $this->errorMsg = "O valor da compra deve ser maior que R$0,00.";
            return null;
        }
        $this->pixCode = $pixPayInService->createLiquidoPixPayIn($this->orderId, $customerEmail, $grandTotal);
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

    private function getIncrementId()
    {
        try {
            $orderObj = $this->checkoutSession->getLastRealOrder();
            return $orderObj->getIncrementId();
        } catch (\Exception $e) {
            echo $e;
            return null;
        }
    }

    private function getGrandTotal($incrementId)
    {
        try {
            return (float) $this->orderData->getOrderGrandTotalFromDatabaseByIncrementId($incrementId) * 100;
        } catch (\Exception $e) {
            echo $e;
            return null;
        }
    }

}

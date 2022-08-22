<?php

namespace Liquido\PayIn\Block;

use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Magento\Checkout\Model\Session;

use \Liquido\PayIn\Service\LiquidoBoletoPayInService;
use \Liquido\PayIn\Helper\Data;

class LiquidoBrlBoleto extends Template
{

    private $boletoUrl = "<boleto_url>";
    private $orderId = "<order_id>";
    private $errorMsg = null;
    protected $checkoutSession;
    protected $orderData;

    public function __construct(
        Context $context,
        Session $checkoutSession,
        LiquidoBoletoPayInService $boletoPayInService,
        Data $orderData,
        array $data = []
    ) {

        parent::__construct($context, $data);
        $this->checkoutSession = $checkoutSession;
        $this->orderData = $orderData;

        // init the Boleto generation in Liquido Virgo API
        $this->orderId = $this->getIncrementId();
        $customerEmail = $this->getCustomerEmail();
        $grandTotal = $this->getGrandTotal($this->orderId);
        if ($grandTotal == 0) {
            $this->errorMsg = "O valor da compra deve ser maior que R$0,00.";
            return null;
        }

        $callbackUrl = $this->orderData->getStoreBaseUrl() . "rest/V1/liquido-callback/post";

        $this->boletoUrl = $boletoPayInService->createLiquidoBoletoPayIn(
            $this->orderId,
            $customerEmail,
            $grandTotal,
            $callbackUrl
        );
    }

    public function getBoletoUrl()
    {
        return $this->boletoUrl;
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
        try {
            $orderObj = $this->checkoutSession->getLastRealOrder();
            return $orderObj->getCustomerEmail();
        } catch (\Exception $e) {
            echo $e;
            return null;
        }
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

<?php

namespace Liquido\PayIn\Block;

use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Magento\Framework\App\ObjectManager;
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

        $objectManager = ObjectManager::getInstance();
        $this->cart = $objectManager->get('\Magento\Checkout\Model\Cart');

        $customerEmail = $this->getCustomerEmail();

        $amountTotal = $this->getCartAmountTotal();
        if ($amountTotal == 0) {
            $this->errorMsg = "O valor da compra deve ser maior que R$0,00.";
            return null;
        }

        $this->orderId = $this->reserveIncrementId();

        $this->pixCode = $pixPayInService->createLiquidoPixPayIn($this->orderId, $customerEmail, $amountTotal);

        $newOrderData = $this->getNewOrderData();
        try {
            $this->orderData->createMageOrder($newOrderData);
        } catch (\Exception $e) {
            echo $e;
        }
    }

    private function getNewOrderData()
    {
        $orderData = [
            'reserved_increment_id'  => $this->orderId,
            'currency_id'  => 'BRL',
            'email'        => $this->getCustomerEmail(), //buyer email id
            'shipping_address' => [
                'firstname'    => 'John', //address Details
                'lastname'     => 'Doe',
                'street' => '123 Demo',
                'city' => 'Mageplaza',
                'country_id' => 'US',
                'region_id' => 12,
                'postcode' => '10019',
                'telephone' => '0123456789',
                'fax' => '32423',
                'save_in_address_book' => 1
            ],
            'items' => $this->getCartItems()
        ];
        return $orderData;
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
            // $objectManager = ObjectManager::getInstance();
            // $cart = $objectManager->get('\Magento\Checkout\Model\Cart');
            return (float) $this->cart->getQuote()->getGrandTotal() * 100;
        } catch (\Exception $e) {
            echo $e;
            return null;
        }
    }

    private function getCartItems()
    {
        try {
            // $objectManager = ObjectManager::getInstance();
            // $cart = $objectManager->get('\Magento\Checkout\Model\Cart');
            // get quote items array
            return $this->cart->getQuote()->getAllItems();
        } catch (\Exception $e) {
            echo $e;
            return null;
        }
    }

    public function getShippingAddress()
    {
        try {
            // $objectManager = ObjectManager::getInstance();
            // $cart = $objectManager->get('\Magento\Checkout\Model\Cart');
            // return $cart->getQuote()->getShippingAddress();
            return $this->cart->getQuote()->getShippingAddress();
        } catch (\Exception $e) {
            echo $e;
            return null;
        }
    }
}

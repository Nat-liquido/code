<?php

namespace Liquido\PayIn\Block;

use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
// use \PHPQRCode\QRcode;

use \Liquido\PayIn\Service\LiquidoPixPayInService;

class PixPayInStepTwo extends Template
{

    private $pixCode = "<access_token>";

    public function __construct(
        Context $context,
        LiquidoPixPayInService $pixPayInService,
        array $data = []
    ) {
        parent::__construct($context, $data);        
        
        $customerEmail = $this->getCustomerEmail();
        
        $this->pixCode = $pixPayInService->createLiquidoPixPayIn($customerEmail);
    }

    public function getPixCode()
    {
        return $this->pixCode;
    }

    private function getCustomerEmail()
    {
        return $this->getRequest()->getParam('email_address');
    }

    private function getCartAmountTotal()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        // $objectManagerType = gettype($objectManager);
        // echo "objectManager Type: $objectManagerType - ";

        $cart = $objectManager->get('\Magento\Checkout\Model\Cart');
        // $cartType = gettype($cart);
        // echo "cart Type: $cartType - ";

        // // get quote items collection
        // $itemsCollection = $cart->getQuote()->getItemsCollection();
        // $itemsCollectionType = gettype($itemsCollection);
        // echo "itemsCollection Type: $itemsCollectionType - ";

        // // get array of all items what can be display directly
        // $itemsVisible = $cart->getQuote()->getAllVisibleItems();
        // $itemsVisibleType = gettype($itemsVisible);
        // echo "itemsVisible Type: $itemsVisibleType - ";

        // // get quote items array
        // $items = $cart->getQuote()->getAllItems();
        // $itemsType = gettype($items);
        // echo "all items Type: $itemsType - ";

        // $items = $cart->getQuote()->getAllItems();
        // $itemsType = gettype($items);
        // echo "all items Type: $itemsType";

        // $subTotal = $cart->getQuote()->getSubtotal();
        // $grandTotal = $cart->getQuote()->getGrandTotal();
        // $amountType = gettype($subTotal);
        // echo "Total a pagar: $amountType";

        $items = $cart->getQuote()->getAllItems();
        $allItemsSize = sizeof($items);
        echo "allItems Size: $allItemsSize";
    }
}

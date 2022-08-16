<?php

namespace Liquido\PayIn\Helper;

use Magento\Framework\App\ObjectManager;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $objectManager;

    public function __construct()
    {
        $this->objectManager = ObjectManager::getInstance();
    }

    public function getOrderGrandTotalFromDatabaseByIncrementId($incrementId)
    {
        // $objectManager = ObjectManager::getInstance();
        $collection = $this->objectManager->create('Magento\Sales\Model\Order');
        $order = $collection->loadByIncrementId($incrementId);
        return $order->getGrandTotal();
    }

    public function getStoreBaseUrl()
    {
        $storeManager = $this->objectManager->get('\Magento\Store\Model\StoreManagerInterface');
        return $storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_WEB);
    }
}

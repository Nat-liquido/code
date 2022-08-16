<?php

namespace Liquido\PayIn\Helper;

use Magento\Framework\App\ObjectManager;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    public function getOrderGrandTotalFromDatabaseByIncrementId($incrementId)
    {
        $objectManager = ObjectManager::getInstance();
        $collection = $objectManager->create('Magento\Sales\Model\Order');
        $order = $collection->loadByIncrementId($incrementId);
        return $order->getGrandTotal();
    }
}

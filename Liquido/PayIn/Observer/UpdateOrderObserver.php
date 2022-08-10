<?php

namespace Liquido\PayIn\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\ObjectManager;

class UpdateOrderObserver implements ObserverInterface
{

    public function __construct()
    {
    }

    public function execute(Observer $observer)
    {
        $data = $observer->getData('orderData');
        $incrementId = $data->getIdempotencyKey();
        $newStatus = $data->getTransferStatus();

        $this->updateOrderStatus($incrementId, $newStatus);
        // return $this;
    }

    private function updateOrderStatus($incrementId, $newStatus)
    {
        try {
    
            $objectManager = ObjectManager::getInstance();
            $incrId = "000000002";
            $collection = $objectManager->create('Magento\Sales\Model\Order');
            $order = $collection->loadByIncrementId($incrId);

            $orderId = $order->getId();
            $orderStatus = $order->getStatus();
            $orderIncrementId = $order->getIncrementId();
            echo "-> entity id: $orderId; -> status: $orderStatus; -> increment id: $orderIncrementId; ";
        } catch (\Exception $e) {
            echo $e;
        }
    }
}

<?php

namespace Liquido\PayIn\Model;

use \Magento\Framework\DataObject;
use \Magento\Framework\Webapi\Rest\Request;
use Magento\Framework\Event\ManagerInterface as EventManager;

class LiquidoCalback
{

	protected $request;
    private $eventManager;

    public function __construct(
        Request $request,
		EventManager $eventManager
    ) {
        $this->request = $request;
		$this->eventManager = $eventManager;
    }

	/**
	 * {@inheritdoc}
	 */
	public function processCallbackRequest()
	{

		// *** TO DO: get headers from request
		
		$body = $this->request->getBodyParams();
		
		$eventType = $body["eventType"];
		// if $eventType == SOMETHING { do something... }

		// if "idempotencyKey" not in $body { do something... }
		// if "transferStatus" not in $body { do something... }
		$idempotencyKey = $body["data"]["chargeDetails"]["idempotencyKey"];
		$transferStatus = $body["data"]["chargeDetails"]["transferStatus"];

		$orderData = new DataObject(array(
			'idempotencyKey' => $idempotencyKey,
			'transferStatus' => $transferStatus,
		));

		$this->eventManager->dispatch('update_order_in_database', ['orderData' => $orderData]);
        
		return [[
			"status" => 200,
			"message" => "received",
			// "body" => $body,
			// "idempotencyKey" => $orderData->getIdempotencyKey(),
			// "transferStatus" => $orderData->getTransferStatus(),
		]];
	}
}

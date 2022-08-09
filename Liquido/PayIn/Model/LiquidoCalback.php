<?php

namespace Liquido\PayIn\Model;

use \Magento\Framework\Webapi\Rest\Request;

class LiquidoCalback
{

	protected $request;

    public function __construct(
        Request $request
    ) {
        $this->request = $request;
    }

	/**
	 * {@inheritdoc}
	 */
	public function processCallbackRequest()
	{
		$body = $this->request->getBodyParams();
        
		return [[
			"status" => 200,
			"message" => "received",
			"body" => $body
		]];
	}
}

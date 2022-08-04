<?php

namespace Liquido\PayIn\Controller\Checkout;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;

use Liquido\PayIn\Api\LiquidoPixClient;

class PixStepTwo extends Action
{

    protected $pixClient;
    private $pixResponse;

    
    protected $resultJsonFactory;

    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;

        // catch customer data from submitted form (like email)
        $this->pixClient = new LiquidoPixClient;
        $this->createLiquidoPixPayIn();
    }

    private function createLiquidoPixPayIn()
    {
        try {
            $this->pixResponse = $this->pixClient->createPixPayIn();
        } catch (\Exception $e){
            // TO DO something...
        }
    }

    public function execute()
    {
        $result = $this->resultJsonFactory->create();
        // $data = ['message' => 'PixStepTwo.php'];

        return $result->setData($this->pixResponse);

        // $this->_view->loadLayout();
        // $this->_view->renderLayout();
    }
}

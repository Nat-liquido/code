<?php

namespace Liquido\PayIn\Controller\Checkout;

use Magento\Framework\App\Action\Action;
// use Magento\Framework\App\Action\Context;
// use Magento\Framework\Controller\Result\JsonFactory;

// use Liquido\PayIn\Api\LiquidoAuthClient;
// use Liquido\PayIn\Api\LiquidoPixClient;

class PixStepTwo extends Action
{

    // protected $authClient;
    // protected $pixClient;
    // private $pixCode;

    
    // protected $resultJsonFactory;

    // public function __construct(
    //     Context $context,
    //     JsonFactory $resultJsonFactory
    // ) {
    //     parent::__construct($context);
    //     $this->resultJsonFactory = $resultJsonFactory;

    //     // catch customer data from submitted form (like email)
    //     $this->authClient = new LiquidoAuthClient;
    //     $authJsonResponse = $this->authClient->authenticate();
    //     $authResponse = json_decode($authJsonResponse);
        
    //     $this->pixClient = new LiquidoPixClient;
    //     $this->createLiquidoPixPayIn($authResponse->access_token);
    // }

    // private function createLiquidoPixPayIn($accessToken)
    // {
    //     try {
    //         $pixJsonResponse = $this->pixClient->createPixPayIn($accessToken);
    //         $pixResponse = json_decode($pixJsonResponse);
    //         $this->pixCode = $pixResponse->qrCode;
    //     } catch (\Exception $e){
    //         echo $e;
    //     }
    // }

    public function execute()
    {
        // $result = $this->resultJsonFactory->create();
        // $data = ['message' => 'PixStepTwo.php'];

        // return $result->setData($this->pixCode);

        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}

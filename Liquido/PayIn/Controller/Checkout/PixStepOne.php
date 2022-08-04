<?php

namespace Liquido\PayIn\Controller\Checkout;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;

class PixStepOne extends Action
{

    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     */
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
    }
    

    /**
     * View  page action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        // $result = $this->resultJsonFactory->create();
        // $data = ['message' => 'PixStepOne.php'];

        // return $result->setData($data);

        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }

}

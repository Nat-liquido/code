<?php

namespace Liquido\PayIn\Controller\Checkout;

use Magento\Framework\App\Action\Action;

class PixStepOne extends Action
{
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}
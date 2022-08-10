<?php

namespace Liquido\PayIn\Controller\Config;

class GeneralConfig extends \Magento\Framework\App\Action\Action
{
   protected $configData;

   public function __construct(
       \Magento\Framework\App\Action\Context $context,
        \Liquido\PayIn\Helper\ConfigData $configData
   )
   {
       $this->configData = $configData;
       return parent::__construct($context);
   }

   public function execute()
   {
       // TODO: Implement execute() method.
       $CheckEnable=$this->configData->getFieldConfig('enable');
       print_r($CheckEnable);
      // You can check value of result by printing $CheckEnable value
   }
}
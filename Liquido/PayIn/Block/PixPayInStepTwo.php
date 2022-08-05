<?php

namespace Liquido\PayIn\Block;

use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
// use \PHPQRCode\QRcode;

use \Liquido\PayIn\Service\LiquidoPixPayInService;

class PixPayInStepTwo extends Template
{

    private $pixCode = "<access_token>";

    public function __construct(
        Context $context,
        LiquidoPixPayInService $pixPayInService,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->pixCode = $pixPayInService->createLiquidoPixPayIn();
    }

    public function getPixCode()
    {
        return $this->pixCode;
    }

}

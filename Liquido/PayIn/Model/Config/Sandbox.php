<?php
namespace Liquido\PayIn\Model\Config;

class Sandbox implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 0, 'label' => __('Yes')],
            ['value' => 1, 'label' => __('No')]
        ];
    }
}
<?php
namespace Liquido\PayIn\Model\Config;

class Custom implements \Magento\Framework\Option\ArrayInterface
{
    public function toOptionArray()
    {
        return [
            ['value' => 0, 'label' => __('Enable')],
            ['value' => 1, 'label' => __('Disable')]
        ];
    }
}
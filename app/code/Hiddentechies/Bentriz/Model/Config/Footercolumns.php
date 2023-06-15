<?php

namespace Hiddentechies\Bentriz\Model\Config;

use Magento\Framework\Option\ArrayInterface;

class Footercolumns implements ArrayInterface
{
    /**
     * {@inheritdoc}
     *
     * @codeCoverageIgnore
     */
    public function toOptionArray(): array
    {
        return [
            ['value' => 'quicklinks', 'label' => __('Quick Links')],
            ['value' => 'staticblock', 'label' => __('Static Block')]
        ];
    }
}

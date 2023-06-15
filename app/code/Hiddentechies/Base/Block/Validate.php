<?php

namespace Hiddentechies\Base\Block;

use Magento\Catalog\Block\Product\Context;
use Magento\Framework\View\Element\Template;

class Validate extends Template {

    public function __construct(
    Context $context, array $data = []
    ) {

        parent::__construct($context, $data);
    }

    protected function _prepareLayout() {
        return parent::_prepareLayout();
    }

}

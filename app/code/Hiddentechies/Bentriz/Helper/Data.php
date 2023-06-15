<?php

namespace Hiddentechies\Bentriz\Helper;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Theme\Block\Html\Header\Logo;

class Data extends AbstractHelper {

    protected StoreManagerInterface $_storeManager;
    protected Logo $logoblock;

    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        Logo $logoblock,
        StoreManagerInterface $storeManager
    ) {
        $this->logoblock = $logoblock;
        $this->_storeManager = $storeManager;
        parent::__construct($context);
    }

    public function getBaseUrl(): string
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }

    public function getIsHome(): bool
    {
        return $this->logoblock->isHomePage();
    }

    public function getMediaUrl(): string
    {
        return $this->_storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
    }

    public function getConfigValue($value = '') {
        return $this->scopeConfig
                ->getValue($value, ScopeInterface::SCOPE_STORE);
    }
}

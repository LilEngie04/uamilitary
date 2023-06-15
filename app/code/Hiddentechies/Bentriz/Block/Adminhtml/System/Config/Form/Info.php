<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Hiddentechies\Bentriz\Block\Adminhtml\System\Config\Form;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Module\ModuleListInterface;
use Magento\Store\Model\ScopeInterface;

class Info extends Field {

    protected ModuleListInterface $moduleList;

    public function __construct(
    ModuleListInterface $moduleList, Context $context, array $data = []
    ) {
        parent::__construct($context, $data);
        $this->moduleList = $moduleList;
    }

    public function render(AbstractElement $element): string
    {
        $m = $this->moduleList->getOne($this->getModuleName());
        $html = '<div style="padding:12px;background-color:#F1F1F1;border:1px solid #d1d1d1;margin-bottom:5px;font-weight: 600;">
            Bentriz: Free Responsive Theme <span style="color: #eb0e0e;">v' . $m['setup_version'] . '</span> was developed by <a href="http://www.hiddentechies.com/" target="_blank">HiddenTechies</a>.
        </div>';

        if (in_array('curl', get_loaded_extensions())) {

            // Define the path for latest notifications
            $file = 'https://www.hiddentechies.com/documentation/notifications/latest_notifications.xml';
            define('LATEST_NOTIFICATIONS_FILE', $file);

            $ch = curl_init();
            $timeout = 5;
            curl_setopt($ch, CURLOPT_URL, LATEST_NOTIFICATIONS_FILE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $response = curl_exec($ch);
            $errmsg = curl_error($ch);
            $curlInfo = curl_getinfo($ch);
            curl_close($ch);

            if ($errmsg === '') {
                $xml = simplexml_load_string($response);
                $title = $xml->item->title;
                $content_info = $xml->item->content_info;

                $html .= '<div class="display-ht-notifications">';
                $html .= $content_info;
                $html .= '</div>';
            }
        }

        return $html;
    }

}

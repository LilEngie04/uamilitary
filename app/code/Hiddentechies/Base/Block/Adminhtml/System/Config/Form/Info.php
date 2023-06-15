<?php

namespace Hiddentechies\Base\Block\Adminhtml\System\Config\Form;

use Magento\Backend\Block\Template\Context;
use Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;
use Magento\Framework\Module\ModuleListInterface;

class Info extends Field {

    protected ModuleListInterface $moduleList;

    public function __construct(
    ModuleListInterface $moduleList, Context $context, array $data = []
    ) {
        $this->moduleList = $moduleList;
        parent::__construct($context, $data);
    }

    public function render(AbstractElement $element): string
    {
        $html = '';

        if (in_array('curl', get_loaded_extensions())) {
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
            curl_close($ch);

            if ($errmsg === '') {
                $xml = simplexml_load_string($response);
                $content_info = $xml->item->content_info;

                $html .= '<div class="display-ht-notifications" style="float: left;clear: both;">';
                $html .= $content_info;
                $html .= '</div>';
            }
        }

        return $html;
    }

}

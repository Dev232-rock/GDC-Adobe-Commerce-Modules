<?php

namespace Adobe\Employee\Block\Adminhtml\Employee\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
/**
 * Save Button Interface class
 */
class SaveButton implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label' => __('Save Employee'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'button' => ['event' => 'save']
                ]
            ],
            'sort_order' => 90
        ];
    }
}

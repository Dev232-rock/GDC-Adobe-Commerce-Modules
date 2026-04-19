<?php

namespace Adobe\Employee\Block\Adminhtml\Employee\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
/**
 * Back Button Provider class
 */
class BackButton implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => "history.back();",
            'class' => 'back',
            'sort_order' => 10
        ];
    }
}

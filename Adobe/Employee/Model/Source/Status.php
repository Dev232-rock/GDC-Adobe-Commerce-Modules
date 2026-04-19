<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;
/**
 * Status OptionSourceInterface class
 */
class Status implements OptionSourceInterface
{
    public function toOptionArray()
    {
        return [
            ['label' => __('Inactive'), 'value' => 0],
            ['label' => __('Active'), 'value' => 1]
        ];
    }
}

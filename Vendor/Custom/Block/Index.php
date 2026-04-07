<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Vendor\Custom\Block;

use Magento\Framework\View\Element\Template;

class Index extends Template
{
    public function getInternName()
    {
        return "John Doe";
    }
}

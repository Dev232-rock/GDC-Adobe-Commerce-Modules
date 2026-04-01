<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Vendor\FeatureToggle\Plugin;

use Vendor\FeatureToggle\Helper\Data;

class ProductNamePlugin
{
    protected $helper;

    public function __construct(Data $helper)
    {
        $this->helper = $helper;
    }

    public function afterGetName(\Magento\Catalog\Model\Product $subject, $result)
    {
        if (!$this->helper->isEnabled()) {
            return $result;
        }

        // Append [Feature ON] only if not already there
        if (strpos($result, '[Feature ON]') === false) {
            $result .= ' [Feature ON]';
        }

        return $result;
    }
}
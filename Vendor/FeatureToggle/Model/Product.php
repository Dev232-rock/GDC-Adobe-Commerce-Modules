<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Vendor\FeatureToggle\Model;

use Magento\Catalog\Model\Product as MagentoProduct;
use Vendor\FeatureToggle\Helper\Data;

class Product extends MagentoProduct
{
    protected $helper;

    // No constructor to avoid breaking Magento's DI
    public function getName()
    {
        if (!$this->helper) {
            $this->helper = \Magento\Framework\App\ObjectManager::getInstance()
                ->get(Data::class);
        }

        $name = parent::getName();
        if (!$this->helper->isEnabled()) {
            return $name;
        }

        return $name . ' [Preference]';
    }
}
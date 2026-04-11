<?php
namespace Vendor\FeatureToggle\Model;

use Magento\Catalog\Model\Product as OriginalProduct;

class CustomClass extends OriginalProduct
{
    public function getName()
    {
        $name = parent::getName();
        return '[FeatureToggle] ' . $name;
    }
}
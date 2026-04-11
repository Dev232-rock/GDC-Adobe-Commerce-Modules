<?php
namespace Vendor\FeatureToggle\Plugin;

use Magento\Catalog\Model\Product;

class ProductPricePlugin
{
    protected $scopeConfig;

    public function __construct(\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function afterGetPrice(Product $subject, $result)
    {
        $isEnabled = $this->scopeConfig->getValue('featuretoggle/general/enabled', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if ($isEnabled) {
            $result = $result * 1.1; // Increase price by 10% for demonstration
        }
        return $result;
    }
}
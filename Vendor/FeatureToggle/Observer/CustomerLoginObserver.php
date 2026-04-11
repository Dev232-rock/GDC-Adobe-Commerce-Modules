<?php
namespace Vendor\FeatureToggle\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Vendor\FeatureToggle\Logger\Logger;
use Magento\Framework\App\Config\ScopeConfigInterface;

class CustomerLoginObserver implements ObserverInterface
{
    protected $logger;
    protected $scopeConfig;

    public function __construct(Logger $logger, ScopeConfigInterface $scopeConfig)
    {
        $this->logger = $logger;
        $this->scopeConfig = $scopeConfig;
    }

    public function execute(Observer $observer)
    {
        $isEnabled = $this->scopeConfig->getValue('featuretoggle/general/enabled', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if (!$isEnabled) {
            return;
        }

        $customer = $observer->getEvent()->getCustomer();
        $this->logger->info('Customer logged in: ' . $customer->getEmail());
    }
}
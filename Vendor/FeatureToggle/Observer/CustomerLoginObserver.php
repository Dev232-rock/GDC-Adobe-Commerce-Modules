<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Vendor\FeatureToggle\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Vendor\FeatureToggle\Helper\Data;
use Psr\Log\LoggerInterface;

class CustomerLoginObserver implements ObserverInterface
{
    protected $helper;
    protected $logger;

    public function __construct(
        Data $helper,
        LoggerInterface $logger
    ) {
        $this->helper = $helper;
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        if (!$this->helper->isEnabled()) {
            return;
        }

        $customer = $observer->getEvent()->getCustomer();
        $this->logger->info('Customer Logged In: ' . $customer->getEmail());
    }
}
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

class OrderPlaceObserver implements ObserverInterface
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

        $order = $observer->getEvent()->getOrder();

        $this->logger->info('Order Placed: #' . $order->getIncrementId());
    }
}
<?php
namespace Vendor\FeatureToggle\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Vendor\FeatureToggle\Helper\Data;
use Psr\Log\LoggerInterface;

class ProductLoadObserver implements ObserverInterface
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

        $product = $observer->getProduct();
        $this->logger->info('Product Loaded: ' . $product->getName());

        $product->setName($product->getData('name') . ' [Observer]');
    }
}
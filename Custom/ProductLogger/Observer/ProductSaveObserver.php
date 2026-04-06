<?php
namespace Custom\ProductLogger\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class ProductSaveObserver implements ObserverInterface
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Constructor
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Execute method for observing the product save event
     *
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $product = $observer->getEvent()->getProduct();
        
        // Get product data (you can log any other attributes here)
        $productId = $product->getId();
        $productName = $product->getName();
        $productSku = $product->getSku();

        // Log product creation or update
        $this->logger->info("Product saved: ID - $productId, Name - $productName, SKU - $productSku");
    }
}

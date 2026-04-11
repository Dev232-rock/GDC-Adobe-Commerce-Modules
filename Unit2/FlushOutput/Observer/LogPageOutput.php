<?php
namespace Unit2\FlushOutput\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class LogPageOutput implements ObserverInterface
{
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        $response = $observer->getEvent()->getResponse();
        $body = $response->getBody();

        $this->logger->info("PAGE HTML: " . substr($body, 0, 1000));
    }
}

<?php
namespace Unit1\CustomConfig\Controller\Test;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\RawFactory;

class Index implements HttpGetActionInterface
{
    private $customConfig;
    private $resultRawFactory;

    public function __construct(
        \Unit1\CustomConfig\Model\Config $customConfig,
        RawFactory $resultRawFactory
    ) {
        $this->customConfig = $customConfig;
        $this->resultRawFactory = $resultRawFactory;
    }

    public function execute()
    {
        $storeId = 1;

        $message = $this->customConfig->get('messages/' . $storeId . '/message');

        /** @var \Magento\Framework\Controller\Result\Raw $result */
        $result = $this->resultRawFactory->create();
        $result->setContents($message);

        return $result;
    }
}

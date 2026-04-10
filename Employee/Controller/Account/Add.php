<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Controller\Account;

use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;

class Add extends Action
{
    protected $resultPageFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        return $this->resultPageFactory->create();
    }
}
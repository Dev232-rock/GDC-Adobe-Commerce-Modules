<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Adobe\Employee\Controller\Account;

use Magento\Customer\Controller\AbstractAccount;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Customer\Model\Session;

/**
 * ListAction class
 */
class ListAction extends AbstractAccount
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * Constructor
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Session $customerSession
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context, $customerSession);
    }

    /**
     * Execute method
     */
    public function execute()
    {
        // Create page
        $resultPage = $this->resultPageFactory->create();

        // Optional: Set page title
        $resultPage->getConfig()->getTitle()->set(__('My Employees'));

        return $resultPage;
    }
}

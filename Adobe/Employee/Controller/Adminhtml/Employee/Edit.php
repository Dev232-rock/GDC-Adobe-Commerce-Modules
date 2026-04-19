<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Controller\Adminhtml\Employee;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
/**
 * Edit Extends Action class
 */
class Edit extends Action
{
    protected $resultPageFactory;

    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();

        $id = $this->getRequest()->getParam('id');

        if ($id) {
            $resultPage->getConfig()->getTitle()->prepend(__('Edit Employee'));
        } else {
            $resultPage->getConfig()->getTitle()->prepend(__('Add New Employee'));
        }

        return $resultPage;
    }
}

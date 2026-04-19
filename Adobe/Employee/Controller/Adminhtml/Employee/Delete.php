<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Controller\Adminhtml\Employee;

use Magento\Backend\App\Action;
/**
 * Delete Extends Action class
 */
class Delete extends Action
{
    protected $employeeFactory;

    public function __construct(
        Action\Context $context,
        \Adobe\Employee\Model\EmployeeFactory $employeeFactory
    ) {
        parent::__construct($context);
        $this->employeeFactory = $employeeFactory;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        $model = $this->employeeFactory->create()->load($id);
        $model->delete();

        return $this->_redirect('*/*/');
    }
}

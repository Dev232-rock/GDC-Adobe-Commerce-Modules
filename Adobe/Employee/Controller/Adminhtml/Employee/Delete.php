<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Controller\Adminhtml\Employee;

use Magento\Backend\App\Action;
use Adobe\Employee\Api\EmployeeRepositoryInterface;

class Delete extends Action
{
    protected $employeeRepository;

    public function __construct(
        Action\Context $context,
        EmployeeRepositoryInterface $employeeRepository
    ) {
        parent::__construct($context);
        $this->employeeRepository = $employeeRepository;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        try {
            $employee = $this->employeeRepository->getById($id);
            $this->employeeRepository->delete($employee);

            $this->messageManager->addSuccessMessage(__('Employee deleted successfully.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        return $this->_redirect('*/*/');
    }
}

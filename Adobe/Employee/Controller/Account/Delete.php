<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Controller\Account;

use Magento\Framework\App\Action\Action;
use Adobe\Employee\Api\EmployeeRepositoryInterface;
/**
 * Delete Action class
 */
class Delete extends Action
{
    protected $employeeRepository;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        EmployeeRepositoryInterface $employeeRepository
    ) {
        parent::__construct($context);
        $this->employeeRepository = $employeeRepository;
    }

    public function execute()
    {
        try {
            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $employee = $this->employeeRepository->getById($id);
                $this->employeeRepository->delete($employee);
                $this->messageManager->addSuccessMessage(__('Employee deleted successfully'));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        return $this->_redirect('employee/account/index');
    }
}

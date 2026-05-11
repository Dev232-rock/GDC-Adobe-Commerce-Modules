<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Controller\Adminhtml\Employee;

use Magento\Backend\App\Action;
use Adobe\Employee\Api\EmployeeRepositoryInterface;
use Adobe\Employee\Api\Data\EmployeeInterfaceFactory;

class Save extends Action
{
    protected $employeeRepository;
    protected $employeeFactory;

    public function __construct(
        Action\Context $context,
        EmployeeRepositoryInterface $employeeRepository,
        EmployeeInterfaceFactory $employeeFactory
    ) {
        parent::__construct($context);
        $this->employeeRepository = $employeeRepository;
        $this->employeeFactory = $employeeFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            try {
                if (!empty($data['entity_id'])) {
                    $employee = $this->employeeRepository->getById($data['entity_id']);
                } else {
                    $employee = $this->employeeFactory->create();
                }

                $employee->setName($data['name']);
                $employee->setJoiningDate($data['joining_date']);
                $employee->setDesignation($data['designation']);
                $employee->setAddress($data['address']);
                $employee->setHobbies(trim($data['hobbies']));
                $employee->setStatus($data['status']);

                $this->employeeRepository->save($employee);

                $this->messageManager->addSuccessMessage(__('Employee saved successfully.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }

        return $this->_redirect('employee/employee/index');
    }
}

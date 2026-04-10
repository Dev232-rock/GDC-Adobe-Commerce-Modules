<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Controller\Account;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Adobe\Employee\Model\EmployeeFactory;

class Save extends Action
{
    protected $employeeFactory;

    public function __construct(
        Context $context,
        EmployeeFactory $employeeFactory
    ) {
        parent::__construct($context);
        $this->employeeFactory = $employeeFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getParams();
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
            try {
                $id = $data['id'] ?? null;

                $employee = $this->employeeFactory->create();

                if ($id) {
                    $employee->load($id);
                }

                // Save fields
                $employee->setName($data['name'] ?? '');
                $employee->setJoiningDate($data['joining_date'] ?? '');
                $employee->setDesignation($data['designation'] ?? '');
                $employee->setAddress($data['address'] ?? '');
                $employee->setStatus(isset($data['status']) ? (int)$data['status'] : 0);

                // ✅ FIXED: hobbies as string
                $hobbies = $data['hobbies'] ?? '';

                if (is_array($hobbies)) {
                    $hobbies = implode(', ', array_filter(array_map('trim', $hobbies)));
                } else {
                    $hobbies = trim($hobbies);
                }

                $employee->setHobbies($hobbies);

                $employee->save();

                $this->messageManager->addSuccessMessage(__('Employee saved successfully.'));
                return $resultRedirect->setPath('*/*/index');

            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(__('Error: %1', $e->getMessage()));
                return $resultRedirect->setPath('*/*/index');
            }
        }

        return $resultRedirect->setPath('*/*/index');
    }
}
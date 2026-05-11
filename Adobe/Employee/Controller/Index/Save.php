<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Controller\Index;

use Adobe\Employee\Model\Employee;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Adobe\Employee\Model\EmployeeFactory;
use Adobe\Employee\Ui\Component\Listing\Column\EmployeeActions;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Customer\Model\Session;

/**
 * Extend Save class
 */
class Save extends Action
{
    protected $employeeFactory;
    protected $resultJsonFactory;
    protected $customerSession;

    public function __construct(
        Context $context,
        EmployeeFactory $employeeFactory,
        JsonFactory $resultJsonFactory,
        Session $customerSession
    ) {
        $this->employeeFactory = $employeeFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->customerSession = $customerSession;
        parent::__construct($context);
    }

    public function execute()
    {
        $result = $this->resultJsonFactory->create();

        try {
            $data = $this->getRequest()->getPostValue();

            $employee = $this->employeeFactory->create();

            if (!empty($data['entity_id'])) {
                $employee->load($data['entity_id']);
            }

            $customerId = $this->customerSession->getCustomerId();

            $employee->setCustomerId($customerId);
            $employee->setName($data['name']);
            $employee->setJoiningDate($data['joining_date']);
            $employee->setDesignation($data['designation']);
            $employee->setAddress($data['address']);
            $employee->setHobbies($data['hobbies']);
            $employee->setStatus($data['status']);

            $employee->save();

            return $result->setData([
                'success' => true,
                'message' => 'Employee saved successfully'
            ]);

        } catch (\Exception $e) {
            return $result->setData([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}

<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Adobe\Employee\Api\EmployeeRepositoryInterface;

class Delete extends Action
{
    protected $resultJsonFactory;
    protected $employeeRepository;

    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        EmployeeRepositoryInterface $employeeRepository
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->employeeRepository = $employeeRepository;
    }

    public function execute()
    {
        $result = $this->resultJsonFactory->create();

        try {
            $id = $this->getRequest()->getParam('entity_id');

            $employee = $this->employeeRepository->getById($id);
            $this->employeeRepository->delete($employee);

            return $result->setData([
                'success' => true,
                'message' => 'Employee deleted successfully'
            ]);
        } catch (\Exception $e) {
            return $result->setData([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}

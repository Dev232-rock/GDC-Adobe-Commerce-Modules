<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Cron;

use Adobe\Employee\Api\EmployeeRepositoryInterface;
use Adobe\Employee\Model\ResourceModel\Employee\CollectionFactory;
use Psr\Log\LoggerInterface;

/**
 * DeleteOldEmployee class
 * Logger Interface
 * Corn Function
 */
class DeleteOldEmployees
{
    protected $collectionFactory;
    protected $employeeRepository;
    protected $logger;

    public function __construct(
        CollectionFactory $collectionFactory,
        EmployeeRepositoryInterface $employeeRepository,
        LoggerInterface $logger
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->employeeRepository = $employeeRepository;
        $this->logger = $logger;
    }

    public function execute()
    {
        try {
            $collection = $this->collectionFactory->create();

            // condition: older than 3 days
            $date = date('Y-m-d', strtotime('-3 days'));

            $collection->addFieldToFilter('created_at', ['lt' => $date]);

            foreach ($collection as $employee) {
                $this->employeeRepository->delete($employee);
            }

            $this->logger->info("Old employees deleted successfully");

        } catch (\Exception $e) {
            $this->logger->error("Cron Error: " . $e->getMessage());
        }
    }
}

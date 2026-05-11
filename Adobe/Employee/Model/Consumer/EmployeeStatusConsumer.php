<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Model\Consumer;

use Psr\Log\LoggerInterface;
use Adobe\Employee\Api\EmployeeRepositoryInterface;

/**
 * EmployeeStatus class
 * Consumer class
 */
class EmployeeStatusConsumer
{
    protected $employeeRepository;
    protected $logger;

    public function __construct(
        EmployeeRepositoryInterface $employeeRepository,
        LoggerInterface $logger
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->logger = $logger;
    }

    public function process($message)
    {
        try {

            $this->logger->info('QUEUE MESSAGE RECEIVED');

            $data = json_decode($message, true);

            if (!isset($data['ids']) || !isset($data['status'])) {
                $this->logger->info('Invalid queue payload');
                return;
            }

            foreach ($data['ids'] as $id) {

                $employee = $this->employeeRepository->getById($id);

                if ($employee->getId()) {

                    $employee->setStatus($data['status']);

                    $this->employeeRepository->save($employee);

                    $this->logger->info(
                        'Employee Updated: ' . $id
                    );
                }
            }

        } catch (\Exception $e) {

            $this->logger->error(
                'QUEUE ERROR: ' . $e->getMessage()
            );
        }
    }
}

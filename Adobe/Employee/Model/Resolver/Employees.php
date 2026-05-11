<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Model\Resolver;

use Magento\Framework\GraphQl\Query\ResolverInterface;
use Adobe\Employee\Api\EmployeeRepositoryInterface;

/**
 * Employees class
 * ResolverInterface
 */
class Employees implements ResolverInterface
{
    /**
     * @var EmployeeRepositoryInterface
     */
    protected $employeeRepository;

    public function __construct(
        EmployeeRepositoryInterface $employeeRepository
    ) {
        $this->employeeRepository = $employeeRepository;
    }

    public function resolve(
        $field,
        $context,
        $info,
        array $value = null,
        array $args = null
    ) {
        $employees = $this->employeeRepository->getList();
        $data = [];

        foreach ($employees as $employee) {
            $data[] = $employee->getData();
        }

        return $data;
    }
}

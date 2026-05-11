<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Model\Resolver;

use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Adobe\Employee\Model\EmployeeFactory;
use Adobe\Employee\Api\EmployeeRepositoryInterface;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;
use Magento\Authorization\Model\UserContextInterface;

/**
 * CreateEmployee class
 * ResolverInterface
 */
class CreateEmployee implements ResolverInterface
{
    protected $employeeFactory;
    protected $employeeRepository;

    public function __construct(
        EmployeeFactory $employeeFactory,
        EmployeeRepositoryInterface $employeeRepository
    ) {
        $this->employeeFactory = $employeeFactory;
        $this->employeeRepository = $employeeRepository;
    }

    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        // Login check
        if ($context->getUserType() !== UserContextInterface::USER_TYPE_CUSTOMER) {
            throw new GraphQlAuthorizationException(__('Customer must be logged in'));
        }

        $customerId = $context->getUserId();

        $employee = $this->employeeFactory->create();

        // Attach owner
        $employee->setCustomerId($customerId);

        $employee->setName($args['name']);
        $employee->setJoiningDate($args['joining_date']);
        $employee->setDesignation($args['designation']);
        $employee->setAddress($args['address'] ?? '');
        $employee->setStatus($args['status']);
        $employee->setHobbies($args['hobbies'] ?? '');

        return $this->employeeRepository->save($employee);
    }
}

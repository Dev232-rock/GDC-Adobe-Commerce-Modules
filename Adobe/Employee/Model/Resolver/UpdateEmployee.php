<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Model\Resolver;

use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Adobe\Employee\Api\EmployeeRepositoryInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;
use Magento\Authorization\Model\UserContextInterface;

/**
 * UpdatedEmployee class
 * ResolverInterface
 */
class UpdateEmployee implements ResolverInterface
{
    protected $employeeRepository;

    public function __construct(
        EmployeeRepositoryInterface $employeeRepository
    ) {
        $this->employeeRepository = $employeeRepository;
    }

    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        // Check customer login
        if ($context->getUserType() !== UserContextInterface::USER_TYPE_CUSTOMER) {
            throw new GraphQlAuthorizationException(__('Customer must be logged in'));
        }

        $customerId = $context->getUserId();

        $employee = $this->employeeRepository->getById($args['entity_id']);

        if (!$employee->getId()) {
            throw new LocalizedException(__('Employee not found'));
        }

        // for Ownership check
        if ($employee->getCustomerId() != $customerId) {
            throw new GraphQlAuthorizationException(__('Unauthorized access'));
        }

        if (isset($args['name'])) {
            $employee->setName($args['name']);
        }

        if (isset($args['joining_date'])) {
            $employee->setJoiningDate($args['joining_date']);
        }

        if (isset($args['designation'])) {
            $employee->setDesignation($args['designation']);
        }

        if (isset($args['address'])) {
            $employee->setAddress($args['address']);
        }

        if (isset($args['status'])) {
            $employee->setStatus($args['status']);
        }

        if (isset($args['hobbies'])) {
            $employee->setHobbies($args['hobbies']);
        }

        return $this->employeeRepository->save($employee);
    }
}

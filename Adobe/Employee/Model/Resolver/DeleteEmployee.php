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
 * DeleteEmployee class
 * ResolverInterface
 */
class DeleteEmployee implements ResolverInterface
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
        // Login check
        if ($context->getUserType() !== UserContextInterface::USER_TYPE_CUSTOMER) {
            throw new GraphQlAuthorizationException(__('Customer must be logged in'));
        }

        $customerId = $context->getUserId();

        $employee = $this->employeeRepository->getById($args['entity_id']);

        if (!$employee->getId()) {
            throw new LocalizedException(__('Employee not found'));
        }

        // for ownership check
        if ($employee->getCustomerId() != $customerId) {
            throw new GraphQlAuthorizationException(__('Unauthorized access'));
        }

        $this->employeeRepository->delete($employee);

        return true;
    }
}

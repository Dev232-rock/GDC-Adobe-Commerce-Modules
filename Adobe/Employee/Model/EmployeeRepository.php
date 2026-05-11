<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Model;

use Adobe\Employee\Api\EmployeeRepositoryInterface;
use Adobe\Employee\Api\Data\EmployeeInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * EmployeeRepository class
 * EmployeeRepositoryInerface
 */
class EmployeeRepository implements EmployeeRepositoryInterface
{
    /**
     * @var \Adobe\Employee\Model\EmployeeFactory
     */
    protected $factory;

    /**
     * @var \Adobe\Employee\Model\ResourceModel\Employee
     */
    protected $resource;

    /**
     * @var \Adobe\Employee\Model\ResourceModel\Employee\CollectionFactory
     */
    protected $collectionFactory;

    /**
     * EmployeeRepository constructor
     *
     * @param \Adobe\Employee\Model\EmployeeFactory $factory
     * @param \Adobe\Employee\Model\ResourceModel\Employee $resource
     * @param \Adobe\Employee\Model\ResourceModel\Employee\CollectionFactory $collectionFactory
     */
    public function __construct(
        \Adobe\Employee\Model\EmployeeFactory $factory,
        \Adobe\Employee\Model\ResourceModel\Employee $resource,
        \Adobe\Employee\Model\ResourceModel\Employee\CollectionFactory $collectionFactory
    ) {
        $this->factory = $factory;
        $this->resource = $resource;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Save employee
     *
     * @param EmployeeInterface $employee
     * @return EmployeeInterface
     * @throws LocalizedException
     */
    public function save(EmployeeInterface $employee)
    {
        if (!$employee->getName()) {
            throw new LocalizedException(__('Name is required'));
        }

        if (!$employee->getDesignation()) {
            throw new LocalizedException(__('Designation is required'));
        }

        if (!$employee->getJoiningDate()) {
            throw new LocalizedException(__('Joining Date is required'));
        }

        $this->resource->save($employee);
        return $employee;
    }

    /**
     * Get employee by ID
     *
     * @param int $id
     * @return EmployeeInterface
     * @throws LocalizedException
     */
    public function getById($id)
    {
        $employee = $this->factory->create();
        $this->resource->load($employee, $id);

        if (!$employee->getId()) {
            throw new LocalizedException(__('Employee not found'));
        }

        return $employee;
    }

    /**
     * Delete employee
     *
     * @param EmployeeInterface $employee
     * @return bool
     */
    public function delete(EmployeeInterface $employee)
    {
        $this->resource->delete($employee);
        return true;
    }

    /**
     * Delete employee by ID
     *
     * @param int $id
     * @return bool
     * @throws LocalizedException
     */
    public function deleteById($id)
    {
        $employee = $this->getById($id);
        return $this->delete($employee);
    }

    /**
     * Get employee list
     *
     * @return EmployeeInterface[]
     *
     */
    public function getList()
    {
        $collection = $this->collectionFactory->create();
        $employees = [];

        foreach ($collection as $employee) {
            $employees[] = $employee;
        }

        return $employees;
    }
}

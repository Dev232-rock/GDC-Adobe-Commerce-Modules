<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Model;

use Adobe\Employee\Api\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    protected $factory, $resource, $collectionFactory;

    public function __construct(
        \Adobe\Employee\Model\EmployeeFactory $factory,
        \Adobe\Employee\Model\ResourceModel\Employee $resource,
        \Adobe\Employee\Model\ResourceModel\Employee\CollectionFactory $collectionFactory
    ) {
        $this->factory = $factory;
        $this->resource = $resource;
        $this->collectionFactory = $collectionFactory;
    }

    public function save($employee)
    {
        $this->resource->save($employee);
        return $employee;
    }

    public function getById($id)
    {
        $emp = $this->factory->create();
        $this->resource->load($emp, $id);
        return $emp;
    }

    public function delete($employee)
    {
        return $this->resource->delete($employee);
    }

    public function getList()
    {
        return $this->collectionFactory->create();
    }
}
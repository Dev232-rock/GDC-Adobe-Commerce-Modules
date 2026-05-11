<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Api;

use Adobe\Employee\Api\Data\EmployeeInterface;

interface EmployeeRepositoryInterface
{
    /**
     * Save employee
     *
     * @param EmployeeInterface $employee
     * @return EmployeeInterface
     */
    public function save(EmployeeInterface $employee);

    /**
     * Get employee by ID
     *
     * @param int $id
     * @return EmployeeInterface
     */
    public function getById($id);

    /**
     * Delete employee
     *
     * @param EmployeeInterface $employee
     * @return bool
     */
    public function delete(EmployeeInterface $employee);

    /**
     * Delete employee by ID
     *
     * @param int $id
     * @return bool
     */
    public function deleteById($id);

    /**
     * Get employee list
     *
     * @return EmployeeInterface[]
     */
    public function getList();
}

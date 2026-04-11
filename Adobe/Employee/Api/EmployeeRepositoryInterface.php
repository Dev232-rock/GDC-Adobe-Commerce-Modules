<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Api;
/**
 * EmployeeRepository interface
 */
interface EmployeeRepositoryInterface
{
    public function save($employee);
    public function getById($id);
    public function delete($employee);
    public function getList();
}

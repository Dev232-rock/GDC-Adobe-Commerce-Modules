<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Block;

use Magento\Framework\View\Element\Template;
use Adobe\Employee\Model\EmployeeFactory;

class Form extends Template
{
    protected $employeeFactory;

    public function __construct(
        Template\Context $context,
        EmployeeFactory $employeeFactory,
        array $data = []
    ) {
        $this->employeeFactory = $employeeFactory;
        parent::__construct($context, $data);
    }

    public function getEmployee()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            $employee = $this->employeeFactory->create()->load($id);
            if ($employee->getId()) {
                return $employee;
            }
        }
        return null;
    }

    /**
     * Safely get hobbies as an array
     *
     * @return array
     */
    public function getHobbies()
    {
        $employee = $this->getEmployee();
        if ($employee && $employee->getHobbies()) {
            $hobbies = $employee->getHobbies();
            if (is_string($hobbies)) {
                return json_decode($hobbies, true) ?: [];
            } elseif (is_array($hobbies)) {
                return $hobbies;
            }
        }
        return [];
    }

    public function getFormAction()
    {
        return $this->getUrl('employee/account/save');
    }
}
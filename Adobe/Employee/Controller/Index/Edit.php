<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;
use Adobe\Employee\Api\EmployeeRepositoryInterface;

/**
 * Edit Extend class
 */
class Edit extends Action
{
    protected $resultPageFactory;
    protected $registry;
    protected $employeeRepository;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        Registry $registry,
        EmployeeRepositoryInterface $employeeRepository
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->registry = $registry;
        $this->employeeRepository = $employeeRepository;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        if ($id) {
            $employee = $this->employeeRepository->getById($id);
            $this->registry->register('current_employee', $employee);
        }

        return $this->resultPageFactory->create();
    }
}

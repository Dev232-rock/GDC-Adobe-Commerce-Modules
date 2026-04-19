<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Controller\Adminhtml\Employee;

use Magento\Backend\App\Action;
use Adobe\Employee\Model\EmployeeFactory;
/**
 * Save Action class
 */
class Save extends Action
{
    protected $employeeFactory;

    public function __construct(
        Action\Context $context,
        EmployeeFactory $employeeFactory
    ) {
        parent::__construct($context);
        $this->employeeFactory = $employeeFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            try {
                $model = $this->employeeFactory->create();

                if (!empty($data['entity_id'])) {
                    $model->load($data['entity_id']);
                }

                $data['hobbies'] = trim($data['hobbies']);

                $model->setData($data);
                $model->save();

                $this->messageManager->addSuccessMessage(__('Employee saved successfully.'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }

        return $this->_redirect('employee/employee/index');
    }
}

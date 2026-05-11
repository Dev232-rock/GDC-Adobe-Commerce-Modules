<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Controller\Adminhtml\Employee;

use Magento\Backend\App\Action;
use Magento\Ui\Component\MassAction\Filter;
use Adobe\Employee\Model\ResourceModel\Employee\CollectionFactory;
use Adobe\Employee\Api\EmployeeRepositoryInterface;

/**
 * MassDelete class
 * Extend Action
 */
class MassDelete extends Action
{
    protected $filter;
    protected $collectionFactory;
    protected $employeeRepository;

    public function __construct(
        Action\Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        EmployeeRepositoryInterface $employeeRepository
    ) {
        parent::__construct($context);
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->employeeRepository = $employeeRepository;
    }

    public function execute()
    {
        try {
            $collection = $this->filter->getCollection($this->collectionFactory->create());

            $count = 0;
            foreach ($collection as $item) {
                $this->employeeRepository->delete($item);
                $count++;
            }

            $this->messageManager->addSuccessMessage(__('%1 record(s) deleted.', $count));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }

        return $this->_redirect('*/*/index');
    }
}

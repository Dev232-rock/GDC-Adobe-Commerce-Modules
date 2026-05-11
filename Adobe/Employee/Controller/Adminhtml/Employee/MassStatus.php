<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Controller\Adminhtml\Employee;

use Magento\Backend\App\Action;
use Magento\Ui\Component\MassAction\Filter;
use Adobe\Employee\Model\ResourceModel\Employee\CollectionFactory;
use Magento\Framework\MessageQueue\PublisherInterface;

/**
 * MassStatus class
 * Action Extend
 */
class MassStatus extends Action
{
    protected $filter;

    protected $collectionFactory;

    protected $publisher;

    public function __construct(
        Action\Context $context,
        Filter $filter,
        CollectionFactory $collectionFactory,
        PublisherInterface $publisher
    ) {
        parent::__construct($context);

        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->publisher = $publisher;
    }

    public function execute()
    {
        try {

            $status = (int)$this->getRequest()->getParam('status');

            $collection = $this->filter->getCollection(
                $this->collectionFactory->create()
            );

            $ids = [];

            foreach ($collection as $employee) {
                $ids[] = $employee->getId();
            }

            $this->publisher->publish(
                'employee.status.update',
                json_encode([
                'ids' => $ids,
                'status' => $status
                ])
            );

            $this->messageManager->addSuccessMessage(
                __('Employees added to queue successfully.')
            );

        } catch (\Exception $e) {

            $this->messageManager->addErrorMessage(
                $e->getMessage()
            );
        }

        return $this->_redirect('*/*/index');
    }
}

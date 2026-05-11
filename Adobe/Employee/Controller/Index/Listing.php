<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Adobe\Employee\Model\ResourceModel\Employee\CollectionFactory;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Customer\Model\Session;

class Listing extends Action
{
    protected $collectionFactory;
    protected $resultJsonFactory;
    protected $customerSession;

    public function __construct(
        Context $context,
        CollectionFactory $collectionFactory,
        JsonFactory $resultJsonFactory,
        Session $customerSession
    ) {
        parent::__construct($context);
        $this->collectionFactory = $collectionFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->customerSession = $customerSession;
    }

    public function execute()
    {
        $result = $this->resultJsonFactory->create();

        $page = (int)$this->getRequest()->getParam('page', 1);
        $pageSize = (int)$this->getRequest()->getParam('pageSize', 5);
        $sortField = $this->getRequest()->getParam('sortField', 'entity_id');
        $sortDirection = $this->getRequest()->getParam('sortDirection', 'DESC');

        $customerId = $this->customerSession->getCustomerId();

        $collection = $this->collectionFactory->create();

        if ($customerId) {
            $collection->addFieldToFilter('customer_id', $customerId);
        }

        $collection->setOrder($sortField, $sortDirection);
        $collection->setPageSize($pageSize);
        $collection->setCurPage($page);

        $items = [];

        foreach ($collection as $employee) {
            $items[] = [
                'entity_id'    => $employee->getId(),
                'name'         => $employee->getName(),
                'joining_date' => $employee->getJoiningDate(),
                'designation'  => $employee->getDesignation(),
                'address'      => $employee->getAddress(),
                'status'       => $employee->getStatus(),
                'hobbies'      => $employee->getHobbies()
            ];
        }

        return $result->setData([
            'items' => $items,
            'total_pages' => ceil($collection->getSize() / $pageSize),
            'is_logged_in' => $customerId ? true : false
        ]);
    }
}

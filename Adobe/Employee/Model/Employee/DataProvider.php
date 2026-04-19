<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Model\Employee;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Adobe\Employee\Model\ResourceModel\Employee\CollectionFactory;
/**
 * DataProvider AbstractDataProvider class
 */
class DataProvider extends AbstractDataProvider
{
    protected $loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();

        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();

        foreach ($items as $employee) {
            $this->loadedData[$employee->getId()] = $employee->getData();
        }

        return $this->loadedData;
    }
}

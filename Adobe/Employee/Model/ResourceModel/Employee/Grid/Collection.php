<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Adobe\Employee\Model\ResourceModel\Employee\Grid;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

/**
 * Collection class
 * SearchResult
 */
class Collection extends SearchResult
{
    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        $mainTable = 'adobe_employee',
        $resourceModel = \Adobe\Employee\Model\ResourceModel\Employee::class
    ) {
        parent::__construct(
            $entityFactory,
            $logger,
            $fetchStrategy,
            $eventManager,
            $mainTable,
            $resourceModel
        );
    }
}

<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Model\ResourceModel\Employee\Grid;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class Collection extends SearchResult
{
    protected function _initSelect()
    {
        parent::_initSelect();

        $this->addFilterToMap('entity_id', 'main_table.entity_id');
        $this->addFilterToMap('name', 'main_table.name');

        return $this;
    }
}

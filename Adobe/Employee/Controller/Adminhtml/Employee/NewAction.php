<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Controller\Adminhtml\Employee;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultFactory;
/**
 * NewAction Extends Action class
 */
class NewAction extends Action
{
    public function execute()
    {
        return $this->resultFactory->create(ResultFactory::TYPE_FORWARD)
            ->forward('edit');
    }
}

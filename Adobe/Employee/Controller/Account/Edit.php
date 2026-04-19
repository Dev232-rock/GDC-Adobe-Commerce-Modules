<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Controller\Account;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
/**
 * Edit Extend Action class
 */
class Edit extends Action
{
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');

        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}

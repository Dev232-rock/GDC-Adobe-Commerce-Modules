<?php
namespace Vendor\Custom\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    const ADMIN_RESOURCE = 'Vendor_Custom::index';

    protected $resultPageFactory;

    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
{
    /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
    $resultPage = $this->resultPageFactory->create();
    $resultPage->addHandle('customadmin_index_index');

    $resultPage->setActiveMenu('Vendor_Custom::index');
    $resultPage->getConfig()->getTitle()->prepend(__('Custom Page'));

    return $resultPage;
}
}
<?php

namespace Adobe\Employee\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Ui\Component\Listing\Columns\Column;

class EmployeeActions extends Column
{
    const EDIT_URL_PATH = 'employee/employee/edit';
    const DELETE_URL_PATH = 'employee/employee/delete';

    protected $urlBuilder;

    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['entity_id'])) {
                    $item[$this->getData('name')] = [
                        'edit' => [
                            'href' => $this->urlBuilder->getUrl(
                                self::EDIT_URL_PATH,
                                ['id' => $item['entity_id']]
                            ),
                            'label' => __('Edit')
                        ],
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                self::DELETE_URL_PATH,
                                ['id' => $item['entity_id']]
                            ),
                            'label' => __('Delete'),
                            'confirm' => [
                                'title' => __('Delete Employee'),
                                'message' => __('Are you sure you want to delete this employee?')
                            ]
                        ]
                    ];
                }
            }
        }

        return $dataSource;
    }
}

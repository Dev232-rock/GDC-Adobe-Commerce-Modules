<?php
namespace Vendor\Custom\Block;

use Magento\Framework\View\Element\Template;

class Index extends Template
{
    public function getInternName()
    {
        return "John Doe";
    }
}
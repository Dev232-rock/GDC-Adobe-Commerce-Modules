<?php
namespace Unit1\CustomConfig\Model;

use Magento\Framework\Config\CacheInterface;
use Magento\Framework\Config\ReaderInterface;

class Config extends \Magento\Framework\Config\Data
{
    public function __construct(
        ReaderInterface $reader,
        CacheInterface $cache,
        $cacheId = 'welcome_messages'
    ) {
        parent::__construct($reader, $cache, $cacheId);
    }
}

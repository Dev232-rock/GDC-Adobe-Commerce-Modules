<?php

namespace Adobe\Employee\Model;

use Magento\Framework\MessageQueue\PublisherInterface;

class Publisher
{
    const TOPIC_NAME = 'employee.status.update';

    protected $publisher;

    public function __construct(
        PublisherInterface $publisher
    ) {
        $this->publisher = $publisher;
    }

    public function publish($data)
    {
        $this->publisher->publish(
            self::TOPIC_NAME,
            json_encode($data)
        );
    }
}

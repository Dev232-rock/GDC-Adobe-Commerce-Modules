<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Model;

use Magento\Framework\Model\AbstractModel;

class Employee extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Adobe\Employee\Model\ResourceModel\Employee::class);
    }
    public function getHobbies(): array
    {
        $hobbies = $this->getData('hobbies');
        if (is_string($hobbies)) {
            $decoded = json_decode($hobbies, true);
            return is_array($decoded) ? $decoded : [];
        }
        return is_array($hobbies) ? $hobbies : [];
    }

    /**
     * Set hobbies as array or string
     */
    public function setHobbies($hobbies): self
    {
        if (is_array($hobbies)) {
            $this->setData('hobbies', json_encode($hobbies));
        } elseif (is_string($hobbies)) {
            $this->setData('hobbies', json_encode(array_map('trim', explode(',', $hobbies))));
        }
        return $this;
    }
}

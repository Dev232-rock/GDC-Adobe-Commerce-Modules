<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Adobe\Employee\Api\Data;

interface EmployeeInterface
{
    const ENTITY_ID    = 'entity_id';
    const NAME         = 'name';
    const JOINING_DATE = 'joining_date';
    const DESIGNATION  = 'designation';
    const ADDRESS      = 'address';
    const STATUS       = 'status';
    const HOBBIES      = 'hobbies';

    /**
     * Get entity ID
     *
     * @return int|null
     */
    public function getEntityId();

    /**
     * Set entity ID
     *
     * @param int $id
     * @return $this
     */
    public function setEntityId($id);

    /**
     * Get name
     *
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * Get joining date
     *
     * @return string|null
     */
    public function getJoiningDate();

    /**
     * Set joining date
     *
     * @param string $joiningDate
     * @return $this
     */
    public function setJoiningDate($joiningDate);

    /**
     * Get designation
     *
     * @return string|null
     */
    public function getDesignation();

    /**
     * Set designation
     *
     * @param string $designation
     * @return $this
     */
    public function setDesignation($designation);

    /**
     * Get address
     *
     * @return string|null
     */
    public function getAddress();

    /**
     * Set address
     *
     * @param string $address
     * @return $this
     */
    public function setAddress($address);

    /**
     * Get status
     *
     * @return int|null
     */
    public function getStatus();

    /**
     * Set status
     *
     * @param int $status
     * @return $this
     */
    public function setStatus($status);

    /**
     * Get hobbies
     *
     * @return string|null
     */
    public function getHobbies();

    /**
     * Set hobbies
     *
     * @param string $hobbies
     * @return $this
     */
    public function setHobbies($hobbies);
}

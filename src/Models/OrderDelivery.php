<?php namespace DivideBV\PHPDivideIQ\Models;

/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 28-07-16
 * Time: 12:14
 */
class OrderDelivery
{
    /**
     * Holds Person class
     * @var Person
     */
    protected $Person;
    /**
     * Holds Address class
     * @var Address
     */
    protected $Address;

    /**
     * @return Person
     */
    public function getPerson()
    {
        return $this->Person;
    }

    /**
     * @param Person $Person
     * @return OrderDelivery
     */
    public function setPerson(Person $Person)
    {
        $this->Person = $Person;
        return $this;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->Address;
    }

    /**
     * @param Address $Address
     * @return OrderDelivery
     */
    public function setAddress(Address $Address)
    {
        $this->Address = $Address;
        return $this;
    }

    public function toArray()
    {
        return array(
            'Person' => $this->Person->toArray(),
            'Address' => $this->Address->toArray()
        );
    }

}
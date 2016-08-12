<?php namespace DivideBV\PHPDivideIQ\Models;

/**
 * This file is part of PHPDivideIQ.
 *
 * PHPDivideIQ is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * (at your option) any later version.
 *
 * PHPDivideIQ is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with PHPDivideIQ.  If not, see <http://www.gnu.org/licenses/>.
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

}

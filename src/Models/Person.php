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

class Person
{
    /**
     * @var
     */
    protected $Gender;
    /**
     * @var
     */
    protected $Initials;
    /**
     * @var
     */
    protected $FirstName;
    /**
     * @var
     */
    protected $SurnamePrefix;
    /**
     * required
     * @var string
     */
    protected $Surname;
    /**
     * @var
     */
    protected $Company;

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->Gender;
    }

    /**
     * @param mixed $Gender
     * @return Person
     */
    public function setGender($Gender)
    {
        $this->Gender = $Gender;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInitials()
    {
        return $this->Initials;
    }

    /**
     * @param mixed $Initials
     * @return Person
     */
    public function setInitials($Initials)
    {
        $this->Initials = $Initials;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->FirstName;
    }

    /**
     * @param mixed $FirstName
     * @return Person
     */
    public function setFirstName($FirstName)
    {
        $this->FirstName = $FirstName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSurnamePrefix()
    {
        return $this->SurnamePrefix;
    }

    /**
     * @param mixed $SurnamePrefix
     * @return Person
     */
    public function setSurnamePrefix($SurnamePrefix)
    {
        $this->SurnamePrefix = $SurnamePrefix;
        return $this;
    }

    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->Surname;
    }

    /**
     * @param string $Surname
     * @return Person
     */
    public function setSurname($Surname)
    {
        $this->Surname = $Surname;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCompany()
    {
        return $this->Company;
    }

    /**
     * @param mixed $Company
     * @return Person
     */
    public function setCompany($Company)
    {
        $this->Company = $Company;
        return $this;
    }
}

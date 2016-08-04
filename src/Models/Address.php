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

class Address
{
    /**
     * required
     * @var string
     */
    protected $Street;
    /**
     * required
     * @var string
     */
    protected $StreetNumber;
    /**
     * @var string
     */
    protected $StreetNumberAdditition;
    /**
     * required
     * @var string
     */
    protected $ZipCode;
    /**
     * required
     * @var string
     */
    protected $City;
    /**
     * required
     * CountryCode (ISO2 or ISO3).
     * @var string
     */
    protected $CountryCode;

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->Street;
    }

    /**
     * @param string $Street
     * @return Address
     */
    public function setStreet($Street)
    {
        $this->Street = $Street;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreetNumber()
    {
        return $this->StreetNumber;
    }

    /**
     * @param string $StreetNumber
     * @return Address
     */
    public function setStreetNumber($StreetNumber)
    {
        $this->StreetNumber = $StreetNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreetNumberAdditition()
    {
        return $this->StreetNumberAdditition;
    }

    /**
     * @param string $StreetNumberAdditition
     * @return Address
     */
    public function setStreetNumberAdditition($StreetNumberAdditition)
    {
        $this->StreetNumberAdditition = $StreetNumberAdditition;
        return $this;
    }

    /**
     * @return string
     */
    public function getZipcode()
    {
        return $this->ZipCode;
    }

    /**
     * @param string $ZipCode
     * @return Address
     */
    public function setZipcode($ZipCode)
    {
        $this->ZipCode = $ZipCode;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->City;
    }

    /**
     * @param string $City
     * @return Address
     */
    public function setCity($City)
    {
        $this->City = $City;
        return $this;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->CountryCode;
    }

    /**
     * @param string $CountryCode
     * @return Address
     */
    public function setCountryCode($CountryCode)
    {
        $this->CountryCode = $CountryCode;
        return $this;
    }

    public function toArray()
    {
        return [
            'Street' => $this->Street,
            'StreetNumber' => $this->StreetNumber,
            'StreetNumberAddition' => $this->StreetNumberAdditition,
            'ZipCode' => $this->ZipCode,
            'City' => $this->City,
            'CountryCode' => $this->CountryCode,
        ];
    }
}

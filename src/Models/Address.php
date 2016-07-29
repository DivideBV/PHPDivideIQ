<?php namespace DivideBV\PHPDivideIQ\Models;

/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 28-07-16
 * Time: 12:14
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
        return array(
            'Street' => $this->Street,
            'StreetNumber' => $this->StreetNumber,
            'StreetNumberAddition' => $this->StreetNumberAdditition,
            'ZipCode' => $this->ZipCode,
            'City' => $this->City,
            'CountryCode' => $this->CountryCode
        );
    }

    private function generateUUID()
    {
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }
}
<?php namespace DivideBV\PHPDivideIQ\Models;

/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 28-07-16
 * Time: 12:14
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

    public function toArray()
    {
        return array(
            'Gender' => $this->Gender,
            'Initials' => $this->Initials,
            'FirstName' => $this->FirstName,
            'SurnamePrefix' => $this->SurnamePrefix,
            'Surname' => $this->Surname,
            'Company' => $this->Company
        );
    }
}
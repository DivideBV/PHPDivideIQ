<?php namespace DivideBV\PHPDivideIQ\Models;
/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 28-07-16
 * Time: 12:15
 */
class Orderline
{
    /**
     * required
     * @var integer
     */
    protected $Number;
    /**
     * required
     * @var string
     */
    protected $EAN;
    /**
     * required
     * @var integer
     */
    protected $Amount;

    /**
     * ArrayOfKeyValuePairOfStringString
     * @var Array
     */
    protected $Metadata;

    /**
     * @return int
     */
    public function getNumber()
    {
        return $this->Number;
    }

    /**
     * @param int $Number
     * @return Orderline
     */
    public function setNumber($Number)
    {
        $this->Number = $Number;
        return $this;
    }

    /**
     * @return string
     */
    public function getEan()
    {
        return $this->EAN;
    }

    /**
     * @param string $EAN
     * @return Orderline
     */
    public function setEan($EAN)
    {
        $this->EAN = $EAN;
        return $this;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->Amount;
    }

    /**
     * @param int $Amount
     * @return Orderline
     */
    public function setAmount($Amount)
    {
        $this->Amount = $Amount;
        return $this;
    }

    public function toArray()
    {
        return array(
            'Number' => $this->Number,
            'EAN' => $this->EAN,
            'Amount' => $this->Amount,
            'MetaData' => [
                'meta' => 'data'
            ]
        );
    }

    public function generateUUID()
    {
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }
}
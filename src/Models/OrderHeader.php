<?php namespace DivideBV\PHPDivideIQ\Models;

/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 28-07-16
 * Time: 12:15
 */
class OrderHeader
{
    /**
     * Ordernumber from retailsystem/shop.
     * required
     * @var string
     */
    protected $OrderNumber;
    /**
     * Timestamp order.
     * required
     * @var \DateTime
     */
    protected $TimeStamp;
    /**
     * Extra information relevant for order processing.
     * @var string
     */
    protected $Attention;

    /**
     * @return string
     */
    public function getOrderNumber()
    {
        return $this->OrderNumber;
    }

    /**
     * @param string $OrderNumber
     */
    public function setOrderNumber($OrderNumber)
    {
        $this->OrderNumber = $OrderNumber;
    }

    /**
     * @return DateTime
     */
    public function getTimeStamp()
    {
        return $this->TimeStamp;
    }

    /**
     * @param DateTime $TimeStamp
     */
    public function setTimeStamp($TimeStamp)
    {
        $this->TimeStamp = $TimeStamp;
    }

    /**
     * @return string
     */
    public function getAttention()
    {
        return $this->Attention;
    }

    /**
     * @param string $Attention
     */
    public function setAttention($Attention)
    {
        $this->Attention = $Attention;
    }

    public function toArray()
    {
        return array(
            'OrderNumber' => $this->OrderNumber,
            'TimeStamp' => $this->TimeStamp->format('Y-m-d h:i:s'),
            'Attention' => $this->Attention
        );
    }

    private function generateUUID()
    {
        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }
}
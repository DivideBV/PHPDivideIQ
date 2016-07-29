<?php namespace DivideBV\PHPDivideIQ\Models;

/**
 * Created by PhpStorm.
 * User: Nav
 * Date: 28-07-16
 * Time: 12:15
 */
class OrderRequest
{
    /**
     * Header information.
     * Required
     * @var OrderHeader
     */
    protected $OrderHeader;
    /**
     * required
     * @var Orderline
     */
    protected $OrderLines = array();
    /**
     * Dropshipment Information
     * @var OrderDelivery
     */
    protected $OrderDelivery;

    /**
     * @return OrderHeader
     */
    public function getOrderHeader()
    {
        return $this->OrderHeader;
    }

    /**
     * @param OrderHeader $OrderHeader
     * @return OrderRequest
     */
    public function setOrderHeader(OrderHeader $OrderHeader)
    {
        $this->OrderHeader = $OrderHeader;
        return $this;
    }

    /**
     * @return Orderline
     */
    public function getOrderLines()
    {
        return $this->OrderLines;
    }

    /**
     * @param Orderline $OrderLines
     * @return OrderRequest
     */
    public function addOrderLine(Orderline $OrderLine)
    {
        $this->OrderLines[] = $OrderLine->toArray();
        return $this;
    }

    /**
     * @return OrderDelivery
     */
    public function getOrderDelivery()
    {
        return $this->OrderDelivery;
    }

    /**
     * @param OrderDelivery $OrderDelivery
     * @return OrderRequest
     */
    public function setOrderDelivery(OrderDelivery $OrderDelivery)
    {
        $this->OrderDelivery = $OrderDelivery;
        return $this;
    }

    public function toArray()
    {
        return array(
            'OrderHeader' => $this->OrderHeader->toArray(),
            'OrderLines' => $this->OrderLines,
            'OrderDelivery' => $this->OrderDelivery->toArray()
        );
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }
}
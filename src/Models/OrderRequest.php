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

class OrderRequest implements \JsonSerializable
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
    protected $OrderLines = [];
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
        return [
            'OrderHeader' => $this->OrderHeader->toArray(),
            'OrderLines' => $this->OrderLines,
            'OrderDelivery' => $this->OrderDelivery->toArray()
        ];
    }

    public function toJson()
    {
        return json_encode($this->toArray());
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        return [
            'OrderHeader' => $this->OrderHeader->toArray(),
            'OrderLines' => $this->OrderLines,
            'OrderDelivery' => $this->OrderDelivery->toArray(),
        ];
    }
}

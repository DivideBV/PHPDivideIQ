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
}

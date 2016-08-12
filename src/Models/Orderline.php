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
}

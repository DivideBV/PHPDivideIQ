<?php namespace DivideBV\PHPDivideIQ;

/**
 * This file is part of PHPDivideIQ.
 *
 * PHPDivideIQ is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
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

class Token
{
    /**
     * The token string.
     *
     * @var string
     */
    protected $token;

    /**
     * The expiration date of the token.
     *
     * @var \DateTime
     */
    protected $expire;

    /**
     * Creates an object to represent a Divide.IQ token.
     *
     * @param string $token
     *     The token string.
     * @param \DateTime $expire
     *     The epiration date of the token.
     */
    public function __construct($token, \DateTime $expire = null)
    {
        $this->token = $token;
        $this->expire = $expire;
    }

    /**
     * Gets the token string.
     *
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Checks whether the token has expired or is still valid.
     *
     * If the token has no expiration date, assumes the token doesn't expire.
     *
     * @param \DateTime $date
     *     (optional) The date to compare with the epiration date of the token.
     *     If not provided, the current time is used.
     *
     * @return bool
     */
    public function expired(\DateTime $date = null)
    {
        // Check if the token has an expiration date.
        if (!$this->expire) {
            return false;
        }

        $date = $date ?: new \DateTime('now', new \DateTimezone('UTC'));

        return ($date > $this->expire);
    }
}

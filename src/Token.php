<?php namespace DivideBV\PHPDivideIQ;

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

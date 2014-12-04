<?php namespace DivideBV\PHPDivideIQ;

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;

class DivideIQ
{
    /**
     * The HTTP client used to establish the connection with Divide.IQ.
     *
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * The username used to authenticate to Divide.IQ.
     *
     * @var string
     */
    protected $username;

    /**
     * The password used to authenticate to Divide.IQ.
     *
     * @var string
     */
    protected $password;

    /**
     * The authentication token and its expiration date.
     *
     * @var array
     */
    protected $authToken;

    /**
     * The access token and its expiration date.
     *
     * @var array
     */
    protected $accessToken;

    /**
     * The refresh token.
     *
     * @var array
     */
    protected $refreshToken;

    /**
     * Creates a Divide.IQ client.
     *
     * @param string $base_url
     *     The URL of the Divide.IQ server.
     * @param string $username
     *     The username used to authenticate.
     * @param string $password
     *     The password used to authenticate.
     */
    public function __construct($base_url, $username, $password)
    {
        // Create the HTTP client.
        $this->client = new HttpClient([
            'base_url' => $base_url,
            'defaults' => [
                'headers' => ['Content-Type' => 'application/json'],
            ],
        ]);

        // Store the credentials in the object.
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Accesses a service provided by Divide.IQ using the stored access token.
     *
     * @param string $serviceName
     *     The codename of the service to access.
     * @param array $payload
     *     (optional) The data to send with the request.
     * @param string $method
     *     (optional) The HTTP method to use to access the service. Defaults to
     *     `GET`.
     *
     * @todo Add list of services to automagically connect to.
     */
    public function access($serviceName, $payload = [], $method = 'GET')
    {
        // Setup the connection.
        $this->setup();

        //$path = $this->services[$serviceName]->path;
        $path = $serviceName;

        switch ($method) {
            case 'GET':
                // Perform the request with the payload as a query string.
                $response = $this->client->get($path, [
                    'headers' => ['Authentication' => $this->accessToken->getToken()],
                    'query' => $payload,
                ]);

                break;
            case 'POST':
                $response = $this->client->post($path, [
                    'headers' => ['Authentication' => $this->accessToken->getToken()],
                ]);

                break;
        }

        // Parse the response body.
        $body = $response->json(['object' => true])->{'nl.divide.iq'};

        return $body;
    }

    /**
     * Sets up a connection with the Divide.IQ server.
     */
    protected function setup()
    {
        // Check if a valid access token exists.
        if ($this->accessToken && !$this->accessToken->expired()) {
            // A valid access token exists, so no need to do anything else.
            return;
        }

        // Check if a refresh token exists.
        if ($this->refreshToken) {
            // Attempt to use the refresh token.
            try {
                $this->refresh();
                return;
            } catch (RequestException $e) {
                // Check if the exception is due to an HTTP 403.
                if ($e->getCode() == 403) {
                    $body = $e->getResponse()->json(['object' => true])->{'nl.divide.iq'};

                    // Check if the error is indeed a "TokenExpired" error, as
                    // expected.
                    if ($body->answer != 'TokenExpired') {
                        // Unexpected error. Pass it up the stack.
                        throw $e;
                    }
                }
                else {
                    // Unexpected error. Pass it up the stack.
                    throw $e;
                }
            }
        }

        // If all else failed, login from scratch and then authenticate.
        $this->login()->authenticate();
    }

    /**
     * Logs in using the provided credentials.
     */
    protected function login()
    {
        // Perform a request with the login credentials in the request header.
        $response = $this->client->get('login', [
            'headers' => ['username'=> $this->username, 'password' => $this->password],
        ]);

        // Parse the response body.
        $body = $response->json(['object' => true])->{'nl.divide.iq'};
        $expire = new \DateTime($body->expiration_date, new \DateTimezone('UTC'));

        // Store the authentication token in the object.
        $this->authToken = new Token($body->authentication_token, $expire);

        return $this;
    }

    /**
     * Authenticates using the stored authentication token.
     *
     * @param bool $refresh
     *     Whether to use the refresh token instead of the authentication token.
     */
    protected function authenticate($refresh = false)
    {
        $token = $refresh ? $this->refreshToken : $this->authToken ;

        $response = $this->client->get('authenticate', [
            'headers' => ['Authentication' => $token->getToken()],
        ]);

        // Parse the response body.
        $body = $response->json(['object' => true])->{'nl.divide.iq'};
        $expire = new \DateTime($body->expiration_date, new \DateTimezone('UTC'));

        // Store the access and refresh tokens in the object.
        $this->accessToken = new Token($body->access_token, $expire);
        $this->refreshToken = new Token($body->refresh_token);

        return $this;
    }

    /**
     * Authenticates using the stored refresh token.
     */
    protected function refresh()
    {
        return $this->authenticate(true);
    }
}

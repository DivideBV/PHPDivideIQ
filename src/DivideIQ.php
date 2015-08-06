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

/**
 * @todo Track settings.
 */

use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\RequestException;

class DivideIQ implements \JsonSerializable
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
     * @var Token
     */
    protected $authToken;

    /**
     * The access token and its expiration date.
     *
     * @var Token
     */
    protected $accessToken;

    /**
     * The refresh token.
     *
     * @var Token
     */
    protected $refreshToken;

    /**
     * Creates a Divide.IQ client.
     *
     * @param string $username
     *     The username used to authenticate.
     * @param string $password
     *     The password used to authenticate.
     * @param bool $staging
     *     Whether to use the staging environment. Defaults to false
     *     (production environment).
     */
    public function __construct($username, $password, $staging = false)
    {
        // The URL of the Divide.IQ environment.
        switch ($staging) {
            case true:
                $base_url = 'https://iqservice.divide.nl/';
                break;
            case false:
                $base_url = 'https://server.divide.nl/divide.api/';
                break;
        }

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
     * @see http://en.wikipedia.org/wiki/Hypertext_Transfer_Protocol#Request_methods
     *
     * @todo Add list of services to automagically connect to.
     * @todo Automatically update settings object.
     */
    public function request($serviceName, $payload = [], $method = 'GET')
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

        // Check if there was an error.
        if (!isset($body->response->content)) {
            $message = $body->response->answer;
            $message .= isset($body->response->message) ? ": {$body->response->message}" : '';

            // Throw an exception with the error description from the service.
            throw new \Exception($message);
        }

        // Return only the response content, without the metadata.
        return $body->response->content;
    }

    /**
     * Serializes the object using JSON.
     *
     * @return string
     *     The JSON representation of the object.
     */
    public function toJson()
    {
        return json_encode($this);
    }

    /**
     * Unserializes the object from JSON.
     *
     * @param string $json
     *     The object as serialized using JSON.
     *
     * @return DivideBV\PHPDivideIQ\DivideIQ
     *     The unserialized object.
     */
    public static function fromJson($json)
    {
        $data = json_decode($json);

        // Recreate the object.
        $object = new static($data->url, $data->username, $data->password);
        $object->authToken = Token::fromJson(json_encode($data->authToken));
        $object->accessToken = Token::fromJson(json_encode($data->accessToken));
        $object->refreshToken = Token::fromJson(json_encode($data->refreshToken));

        return $object;
    }

    /**
     * Implements \JsonSerializable::jsonSerialize.
     */
    public function jsonSerialize()
    {
        return [
            'url' => $this->client->getBaseUrl(),
            'username' => $this->username,
            'password' => $this->password,
            'authToken' => $this->authToken,
            'accessToken' => $this->accessToken,
            'refreshToken' => $this->refreshToken,
        ];
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
                } else {
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
        $response = $this->client->get('services/login', [
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

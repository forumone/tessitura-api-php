<?php

/**
 * Tessitura REST API Client
 *
 * @category Client
 * @package  ForumOne/Tessitura
 */

namespace ForumOne\Tessitura;

use ForumOne\Tessitura\HttpClient\HttpClient;

/**
 * REST API Client class.
 *
 * @package ForumOne/Tessitura
 */
class Client
{
    /**
     * Tessitura REST API Client version.
     */
    public const VERSION = '1.0.0';

    /**
     * HttpClient instance.
     *
     * @var HttpClient
     */
    public $http;

    /**
     * Initialize client.
     *
     * @param string $url            Store URL.
     * @param string $authUser       Tessitura User.
     * @param string $authPass       Tessitura Password.
     * @param array  $options        Options (user_agent, timeout, verify_ssl, follow_redirects).
     */
    public function __construct($url, $authUser, $authPass, $options = [])
    {
        $this->http = new HttpClient($url, $authUser, $authPass, $options);
    }

    /**
     * POST method.
     *
     * @param string $endpoint API endpoint.
     * @param array  $data     Request data.
     *
     * @return \stdClass
     */
    public function post($endpoint, $data)
    {
        return $this->http->request($endpoint, 'POST', $data);
    }

    /**
     * PUT method.
     *
     * @param string $endpoint API endpoint.
     * @param array  $data     Request data.
     *
     * @return \stdClass
     */
    public function put($endpoint, $data)
    {
        return $this->http->request($endpoint, 'PUT', $data);
    }

    /**
     * GET method.
     *
     * @param string $endpoint   API endpoint.
     * @param array  $parameters Request parameters.
     *
     * @return \stdClass
     */
    public function get($endpoint, $parameters = [])
    {
        return $this->http->request($endpoint, 'GET', [], $parameters);
    }

    /**
     * DELETE method.
     *
     * @param string $endpoint   API endpoint.
     * @param array  $parameters Request parameters.
     *
     * @return \stdClass
     */
    public function delete($endpoint, $parameters = [])
    {
        return $this->http->request($endpoint, 'DELETE', [], $parameters);
    }

    /**
     * OPTIONS method.
     *
     * @param string $endpoint API endpoint.
     *
     * @return \stdClass
     */
    public function options($endpoint)
    {
        return $this->http->request($endpoint, 'OPTIONS', [], []);
    }
}

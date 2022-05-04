<?php

/**
 * Tessitura REST API HTTP Client Options
 *
 * @category HttpClient
 * @package  ForumOne/Tessitura
 */

namespace ForumOne\Tessitura\HttpClient;

/**
 * REST API HTTP Client Options class.
 *
 * @package ForumOne/Tessitura
 */
class Options
{

    /**
     * Default request timeout.
     */
    public const TIMEOUT = 15;

    /**
     * Default User Agent.
     * No version number.
     */
    public const USER_AGENT = 'Tessitura API Client-PHP';

    /**
     * Options.
     *
     * @var array
     */
    private $options;

    /**
     * Initialize HTTP client options.
     *
     * @param array $options Client options.
     */
    public function __construct($options)
    {
        $this->options = $options;
    }

    /**
     * Check if need to verify SSL.
     *
     * @return bool
     */
    public function verifySsl()
    {
        return isset($this->options['verify_ssl']) ? (bool) $this->options['verify_ssl'] : true;
    }

    /**
     * Get timeout.
     *
     * @return int
     */
    public function getTimeout()
    {
        return isset($this->options['timeout']) ? (int) $this->options['timeout'] : self::TIMEOUT;
    }

    /**
     * Basic Authentication as query string.
     * Some old servers are not able to use CURLOPT_USERPWD.
     *
     * @return bool
     */
    public function isQueryStringAuth()
    {
        return isset($this->options['query_string_auth']) ? (bool) $this->options['query_string_auth'] : false;
    }

    /**
     * Custom user agent.
     *
     * @return string
     */
    public function userAgent()
    {
        return isset($this->options['user_agent']) ? $this->options['user_agent'] : self::USER_AGENT;
    }

    /**
     * Get follow redirects.
     *
     * @return bool
     */
    public function getFollowRedirects()
    {
        return isset($this->options['follow_redirects']) ? (bool) $this->options['follow_redirects'] : false;
    }

    /**
     * Check is it needed to mask all non-GET/POST methods (PUT/DELETE/etc.) by using POST method with added
     * query parameter ?_method=METHOD into URL.
     *
     * @return bool
     */
    public function isMethodOverrideQuery()
    {
        return isset($this->options['method_override_query']) && $this->options['method_override_query'];
    }

    /**
     * Check is it needed to mask all non-GET/POST methods (PUT/DELETE/etc.) by using POST method with added
     * "X-HTTP-Method-Override: METHOD" HTTP header into request.
     *
     * @return bool
     */
    public function isMethodOverrideHeader()
    {
        return isset($this->options['method_override_header']) && $this->options['method_override_header'];
    }
}

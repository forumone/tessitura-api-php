<?php

/**
 * Tessitura Basic Authentication
 *
 * @category HttpClient
 * @package  ForumOne/Tessitura
 */

namespace ForumOne\Tessitura\HttpClient;

/**
 * Basic Authentication class.
 *
 * @package ForumOne/Tessitura
 */
class BasicAuth
{
    /**
     * cURL handle.
     *
     * @var resource
     */
    protected $ch;

    /**
     * Tessitura User.
     *
     * @var string
     */
    protected $authUser;

    /**
     * Tessitura Password.
     *
     * @var string
     */
    protected $authPass;

    /**
     * Do query string auth.
     *
     * @var bool
     */
    protected $doQueryString;

    /**
     * Request parameters.
     *
     * @var array
     */
    protected $parameters;

    /**
     * Initialize Basic Authentication class.
     *
     * @param resource $ch             cURL handle.
     * @param string   $authUser       Tessitura User.
     * @param string   $authPass       Tessitura Password.
     * @param bool     $doQueryString  Do or not query string auth.
     * @param array    $parameters     Request parameters.
     */
    public function __construct($ch, $authUser, $authPass, $doQueryString, $parameters = [])
    {
        $this->ch             = $ch;
        $this->authUser    = $authUser;
        $this->authPass = $authPass;
        $this->doQueryString  = $doQueryString;
        $this->parameters     = $parameters;

        $this->processAuth();
    }

    /**
     * Process auth.
     */
    protected function processAuth()
    {
        if ($this->doQueryString) {
            $this->parameters['auth_user']    = $this->authUser;
            $this->parameters['auth_pass'] = $this->authPass;
        } else {
            \curl_setopt($this->ch, CURLOPT_USERPWD, $this->authUser . ':' . $this->authPass);
        }
    }

    /**
     * Get parameters.
     *
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }
}

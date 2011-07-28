<?php

namespace Vich\BitlyBundle\Builder;

/**
 * ApiRequestBuilder.
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
class ApiRequestBuilder
{
    /**
     * @var string $login
     */
    protected $login;
    
    /**
     * @var string $apiKey
     */
    protected $apiKey;
    
    /**
     * @var string $baseUrl
     */
    protected $baseUrl = 'http://api.bitly.com/v3';
    
    /**
     * Constructs a new instance of ApiRequestBuilder.
     * 
     * @param type $login The login name
     * @param type $apiKey The api key
     */
    public function __construct($login, $apiKey)
    {
        $this->login = $login;
        $this->apiKey = $apiKey;
    }
    
    /**
     * Builds a new api request url.
     * 
     * @param type $method The api method name
     * @param array $options The method options
     * @return string The request url
     */
    public function build($method, array $options = array())
    {
        $options = array_merge($options, $this->getCredentials());
        
        return sprintf(
            '%s/%s?%s',
            $this->baseUrl,
            $method,
            http_build_query($options)
        );
    }
    
    /**
     * Gets an array containing the bit.ly service credentials.
     * 
     * @return array The credentials
     */
    private function getCredentials()
    {
        return array(
            'login' => $this->login,
            'apiKey' => $this->apiKey,
            'format' => 'json'
        );
    }
}

<?php

namespace Vich\BitlyBundle\Api;

use Vich\BitlyBundle\Builder\ApiRequestBuilder;

/**
 * BitlyApi.
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
class BitlyApi
{
    /**
     * @var Vich\BitlyBundle\Bitly\Builder\ApiRequestBuilder $builder
     */
    protected $builder;
    
    /**
     * Constructs a new instance of BitlyApi.
     * 
     * @param Vich\BitlyBundle\Builder\ApiRequestBuilder $builder 
     */
    public function __construct(ApiRequestBuilder $builder)
    {
        $this->builder = $builder;
    }
    
    /**
     * Shortens the specified url.
     * 
     * @param string $url The url to shorten
     * @return string The shortened url
     */
    public function shorten($url)
    {
        $request = $this->builder->build('shorten', array('longUrl' => $url));
        
        $json = file_get_contents($request);
        
        $result = json_decode($json, true);
        
        if ($result['status_code'] != 200) {
            return $url;
        }
        
        return $result['data']['url'];
    }
    
    /**
     * Expands the specified url.
     * 
     * @param string $url The shortened url
     * @return string The expanded url
     */
    public function expand($url)
    {
        $request = $this->builder->build('expand', array('shortUrl' => $url));
        
        $json = file_get_contents($request);
        
        $result = json_decode($json, true);
        
        if ($result['status_code'] != 200) {
            return $url;
        }
        
        return $result['data']['expand'][0]['long_url'];
    }
}

<?php

namespace Vich\BitlyBundle\Twig;

use Vich\BitlyBundle\Api\BitlyApi;

/**
 * BitlyExtension.
 * 
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
class BitlyExtension extends \Twig_Extension
{   
    /**
     * @var Vich\BitlyBundle\Api\BitlyApi $api
     */
    private $api;
    
    /**
     * Constructs a new instance of BitlyExtension.
     * 
     * @param Vich\BitlyBundle\Api\BitlyApi $api
     */
    public function __construct(BitlyApi $api)
    {
        $this->api = $api;
    }
    
    /**
     * Returns the canonical name of this extension.
     *
     * @return string The canonical name
     */
    public function getName()
    {
        return 'vich_bitly';
    }
    
    /**
     * Returns a list of twig functions.
     *
     * @return array An array
     */
    public function getFunctions()
    {
        $names = array(
            'vich_bitly_shorten'  => 'shortenUrl',
            'vich_bitly_expand'   => 'expandUrl'
        );
        
        $funcs = array();
        foreach ($names as $twig => $local) {
            $funcs[$twig] = new \Twig_Function_Method($this, $local);
        }
        
        return $funcs;
    }
    
    /**
     * Shortens the specified url.
     * 
     * @param string $url The url
     * @return string The shortened url
     */
    public function shortenUrl($url)
    {
        if (!is_string($url)) {
            throw new \InvalidArgumentException('The url to shorten must be a string');
        }
        
        return $this->api->shorten($url);
    }
    
    /**
     * Expands the specified url.
     * 
     * @param string $url The url
     * @return string The expanded url
     */
    public function expandUrl($url)
    {
        if (!is_string($url)) {
            throw new \InvalidArgumentException('The url to expand must be a string');
        }
        
        return $this->api->expand($url);
    }
}
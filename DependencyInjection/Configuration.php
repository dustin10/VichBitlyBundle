<?php

namespace Vich\BitlyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration.
 * 
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Gets the configuration tree builder for the extension.
     * 
     * @return TreeBuilder The configuration tree builder
     */
    public function getConfigTreeBuilder()
    {
        $tb = new TreeBuilder();
        $root = $tb->root('vich_bitly');
        
        $root
            ->children()
                ->scalarNode('login_name')->isRequired()->end()
                ->scalarNode('api_key')->isRequired()->end()
            ->end()
        ;
        
        return $tb;
    }
}
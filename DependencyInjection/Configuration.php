<?php

namespace Vich\BitlyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
 * Configuration.
 * 
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
class Configuration
{
    /**
     * Gets the configuration tree for the extension.
     * 
     * @return Tree The configuration tree
     */
    public function getConfigTree()
    {
        $tb = new TreeBuilder();
        $root = $tb->root('vich_bitly');
        
        $root
            ->children()
                ->scalarNode('login_name')->cannotBeOverwritten()->isRequired()->end()
                ->scalarNode('api_key')->cannotBeOverwritten()->isRequired()->end()
            ->end()
        ;
        
        return $tb->buildTree();
    }
}
<?php

namespace Vich\BitlyBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Definition\Processor;
use Vich\BitlyBundle\DependencyInjection\Configuration;

/**
 * VichBitlyExtension.
 *
 * @author Dustin Dobervich <ddobervich@gmail.com>
 */
class VichBitlyExtension extends Extension
{   
    /**
     * Loads the extension.
     * 
     * @param array $configs The configuration
     * @param ContainerBuilder $container The container builder
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $processor = new Processor();
        $configuration = new Configuration();
        
        $config = $processor->process($configuration->getConfigTree(), $configs);
        
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        
        $toLoad = array('services.xml', 'twig.xml');
        foreach ($toLoad as $file) {
            $loader->load($file);
        }
        
        $container->setParameter('vich_bitly.login_name', $config['login_name']);
        $container->setParameter('vich_bitly.api_key', $config['api_key']);
    }
    
}
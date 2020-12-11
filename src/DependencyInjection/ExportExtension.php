<?php

namespace Kematjaya\ExportBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ExportExtension extends Extension 
{
    public function load(array $configs, ContainerBuilder $container) 
    {
        $loader = new YamlFileLoader($container, new FileLocator(dirname(__DIR__).'/Resources/config'));
        $loader->load('services.yml');
    }
}

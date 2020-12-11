<?php

namespace Kematjaya\ExportBundle\Test;

use Kematjaya\Export\Manager\ExportManager;
use Kematjaya\Export\Manager\ManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ExportBundleTest extends WebTestCase
{
    public function testInstanceBundle()
    {
        $client = parent::createClient();
        $container = $client->getContainer();
        $this->assertTrue($container->has(ManagerInterface::class));
        $this->assertInstanceOf(ExportManager::class, $container->get(ManagerInterface::class));
    }
    
    public static function getKernelClass() 
    {
        return AppKernelTest::class;
    }
}

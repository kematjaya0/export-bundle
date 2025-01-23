<?php

namespace Kematjaya\ExportBundle\Tests;

use Kematjaya\Export\Normalizer\FileNormalizerInterface;
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
    
    public function testFIleNormalizer()
    {
        $client = parent::createClient();
        $container = $client->getContainer();
        $this->assertTrue($container->has('kematjaya.file_normalizer'));
        $this->assertInstanceOf(FileNormalizerInterface::class, $container->get('kematjaya.file_normalizer'));
    }
    
    public static function getKernelClass(): string
    {
        return AppKernelTest::class;
    }
}

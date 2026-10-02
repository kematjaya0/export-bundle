<?php

namespace Kematjaya\ExportBundle\Tests;

use Kematjaya\Export\Manager\ExportManager;
use Kematjaya\Export\Manager\ManagerInterface;
use Kematjaya\Export\Normalizer\FileNormalizerInterface;
use Kematjaya\Export\Processor\PDF\DOMPDFProcessor;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @author Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ExportBundleTest extends KernelTestCase
{
    public function testInstanceBundle(): void
    {
        $container = static::getContainer();
        $this->assertTrue($container->has(ManagerInterface::class));
        $this->assertInstanceOf(ExportManager::class, $container->get(ManagerInterface::class));
    }

    public function testFIleNormalizer(): void
    {
        $container = static::getContainer();
        $this->assertTrue($container->has('kematjaya.file_normalizer'));
        $this->assertInstanceOf(FileNormalizerInterface::class, $container->get('kematjaya.file_normalizer'));
    }

    public function testRenderPdfWithEmbeddedImage(): void
    {
        $container = static::getContainer();
        $html = $container->get('twig')->render('public.html.twig');
        $response = $container->get(ManagerInterface::class)->render(sprintf('<img src="%s">', trim($html)), new DOMPDFProcessor('doc.pdf'));

        $this->assertStringStartsWith('%PDF', $response->getContent());
    }

    protected static function getKernelClass(): string
    {
        return AppKernel::class;
    }
}

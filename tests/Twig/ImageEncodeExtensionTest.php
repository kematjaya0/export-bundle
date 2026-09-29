<?php

namespace Kematjaya\ExportBundle\Tests\Twig;

use Kematjaya\ExportBundle\Tests\AppKernel;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Twig\Error\RuntimeError;

class ImageEncodeExtensionTest extends KernelTestCase
{
    const PIXEL = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPhfDwAChwGA60e6kgAAAABJRU5ErkJggg==';

    protected static function getKernelClass(): string
    {
        return AppKernel::class;
    }

    public function testPublicPath()
    {
        $this->assertSame(self::PIXEL, trim(static::getContainer()->get('twig')->render('public.html.twig')));
    }

    public function testProjectPath()
    {
        $this->assertSame(self::PIXEL, trim(static::getContainer()->get('twig')->render('project.html.twig')));
    }

    public function testProjectPathWithoutLeadingSlash()
    {
        $twig = static::getContainer()->get('twig');
        $template = $twig->createTemplate('{{ "public/images/pixel.png"|base64_encode }}');

        $this->assertSame(self::PIXEL, trim($template->render()));
    }

    public function testFileNotFound()
    {
        $twig = static::getContainer()->get('twig');
        $template = $twig->createTemplate('{{ "images/none.png"|base64_encode(true) }}');

        $this->expectException(RuntimeError::class);
        $this->expectExceptionMessage("cannot find file");
        $template->render();
    }
}

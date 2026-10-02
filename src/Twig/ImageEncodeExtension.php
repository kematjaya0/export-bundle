<?php

namespace Kematjaya\ExportBundle\Twig;

use Kematjaya\Export\Normalizer\FileNormalizerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\File;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * @package Kematjaya\ExportBundle\Twig
 * @license https://opensource.org/licenses/MIT MIT
 * @author  Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ImageEncodeExtension extends AbstractExtension
{
    private readonly string $projectPath;

    public function __construct(ParameterBagInterface $bag, private readonly FileNormalizerInterface $normalizer)
    {
        $this->projectPath = $bag->get('kernel.project_dir');
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('base64_encode', $this->base64Encode(...), ['is_safe' => ['html']]),
        ];
    }

    public function base64Encode(string $path, bool $public = false): ?string
    {
        $relativePath = ltrim($path, '/\\');
        if (true === $public) {
            $relativePath = "public" . DIRECTORY_SEPARATOR . $relativePath;
        }

        $filePath = $this->projectPath . DIRECTORY_SEPARATOR . $relativePath;
        if (is_file($filePath)) {

            return $this->normalizer->normalize(new File($filePath));
        }

        throw new \Exception(sprintf("cannot find file '%s'", $filePath));
    }
}

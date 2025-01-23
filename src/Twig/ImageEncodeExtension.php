<?php

namespace Kematjaya\ExportBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Kematjaya\Export\Normalizer\FileNormalizerInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * @package Kematjaya\ExportBundle\Twig
 * @license https://opensource.org/licenses/MIT MIT
 * @author  Nur Hidayatullah <kematjaya0@gmail.com>
 */
class ImageEncodeExtension extends AbstractExtension
{
    private ?string $projectPath;
    
    public function __construct(ParameterBagInterface $bag, private FileNormalizerInterface $normalizer)
    {
        $this->projectPath = $bag->get('kernel.project_dir');
    }
    
    public function getFilters():array
    {
        return [
            new TwigFilter('base64_encode', [$this, 'base64Encode'], ['is_safe' => ['html']])
        ];
    }
    
    public function base64Encode(string $path, bool $public = false):?string
    {
        if (true === $public) {
            $filePath = $this->projectPath . DIRECTORY_SEPARATOR . "public" .DIRECTORY_SEPARATOR . $path;
            if (file_exists($filePath)) {
                return $this->normalizer->normalize(new File($filePath));
            }
            
            throw new \Exception(sprintf("cannot find file '%s'", $filePath));
        }
        
        $filePath = $this->projectPath . $path;
        if (file_exists($filePath)) {
            
            return $this->normalizer->normalize(new File($filePath));
        }
        
        throw new \Exception(sprintf("cannot find file '%s'", $filePath));
    }
}

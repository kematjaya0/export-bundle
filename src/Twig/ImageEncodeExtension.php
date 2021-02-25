<?php

/**
 * This file is part of the export-bundle.
 */

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
    
    /**
     * 
     * @var string
     */
    private $projectPath;
    
    /**
     * 
     * @var FileNormalizerInterface
     */
    private $normalizer;
    
    public function __construct(ParameterBagInterface $bag, FileNormalizerInterface $normalizer) 
    {
        $this->projectPath = $bag->get('kernel.project_dir');
        $this->normalizer = $normalizer;
    }
    
    public function getFilters()
    {
        return [
            new TwigFilter('base64_encode', [$this, 'base64Encode'], ['is_safe' => ['html']])
        ];
    }
    
    public function base64Encode(string $path)
    {
        $filePath = $this->projectPath . $path;
        if (file_exists($filePath)) {
            
            return $this->normalizer->normalize(new File($filePath));
        }
        
        throw new \Exception(sprintf("cannot find file '%s'", $filePath));
    }
}

# export-bundle
export module to excel, pdf, or etc for symfony app
If you install this component outside of a Symfony application, you can use [kematjaya/export](https://github.com/kematjaya0/export)
1. installation
```
composer require kematjaya/export-bundle
```

2. add to config/bundles.php
```
...
Kematjaya\ExportBundle\ExportBundle::class => ['all' => true]
...
```
3. using inside Controller

```
// src/Controller/TestController.php

...
use Kematjaya\Export\Processor\Excel\PHPSpreadsheetProcessor; // convert array to excel document
use Kematjaya\Export\Processor\Excel\HtmlToExcel;    // convert html to excel document
use Kematjaya\Export\Processor\PDF\DOMPDFProcessor; // convert html to PDF document
use Kematjaya\Export\Manager\ManagerInterface;
...

public function pdfDocument(ManagerInterface $exportManager)
{
    // html to pdf 
    $pdf = $exportManager->render('<h3>TEST</h3>', new DOMPDFProcessor('doc.pdf'));

    // html to excel
    $htmlToExcel = $manager->render('<table></table>', new HtmlToExcel('doc.xls'));
    
    // array to excel
    $data = [
        ['a', 'b', 'c']
    ];
    $arrayToExcel = $manager->render($data, new PHPSpreadsheetProcessor());
}
...
```

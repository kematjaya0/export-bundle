# export-bundle
export module to excel, pdf, or etc for symfony app

Branch `6.4`: Symfony 6.4, PHP >= 8.1.
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
use Kematjaya\Export\Processor\Excel\SpreadsheetFromArrayProcessor; // convert array to excel document
use Kematjaya\Export\Processor\Excel\HtmlToExcel;    // convert html to excel document
use Kematjaya\Export\Processor\PDF\DOMPDFProcessor; // convert html to PDF document
use Kematjaya\Export\Manager\ManagerInterface;
...

public function pdfDocument(ManagerInterface $exportManager)
{
    // html to pdf 
    $pdf = $exportManager->render('<h3>TEST</h3>', new DOMPDFProcessor('doc.pdf'));

    // html to excel
    $htmlToExcel = $exportManager->render('<table><tr><td>a</td></tr></table>', new HtmlToExcel('doc.xlsx'));
    
    // array to excel
    $data = [
        ['a', 'b', 'c']
    ];
    $arrayToExcel = $exportManager->render($data, new SpreadsheetFromArrayProcessor('data.xlsx'));
}
...
```
4. embed image (base64 data uri) di template twig, mis. untuk PDF
```
{# file di <project>/public/images/logo.png #}
<img src="{{ 'images/logo.png'|base64_encode(true) }}">
{# file relatif terhadap <project> #}
<img src="{{ 'assets/logo.png'|base64_encode }}">
```

## Test
```
LOCAL_PACKAGES="export" sh docker/test.sh all
```

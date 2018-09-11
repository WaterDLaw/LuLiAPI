<?php

namespace App;

use mikehaertl\pdftk\Pdf;
use mikehaertl\pdftk\XfdfFile;
use mikehaertl\pdftk\FdfFile;

/*
// Fill form with data array
//$path = storage_path('app/public/pdf/my_converted.pdf');
//info($path);
$pdf = new Pdf('/home/danytlaw/Downloads/my_converted.pdf');

$xfdf = new XfdfFile(['Text9' => 'Daniel']);
$xfdf->saveAs('/home/danytlaw/Downloads/data.xfdf');

$pdf->fillForm('/home/danytlaw/Downloads/data.xfdf');
//$pdf->flatten();      

$pdf->send("Test");

 /*    
 if (!$pdf->saveAs('/home/danytlaw/Downloads/filled.pdf')) {
     $error = $pdf->getError();
     info($error);
 }
 */

$pdf = new Pdf('./my_converted.pdf', [
    'command' => '/app/vendor/pdftk/bin/pdftk',
	'useExec' => true
]);

//$data = $pdf->getDataFields();

// Get data as string
//echo $data;


$pdf->fillForm([
        'Text9' => 'Herzog',
        'Text10' => 'Daniel'
    ])
->needAppearances();

// Check for errors
if (!$pdf->saveAs('filled.pdf')) {
    $error = $pdf->getError();
	echo $error;
}
?>
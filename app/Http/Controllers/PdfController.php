<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use mikehaertl\pdftk\Pdf;
use mikehaertl\pdftk\XfdfFile;
use mikehaertl\pdftk\FdfFile;
use Response;

class PdfController extends Controller
{
    //Verordnungsformular08_D

    public function getVerordnungsformular(){


        // Get all values for the form
        


        // Fill form with data array
        $path = '/app/storage/app/public/pdf/my_converted.pdf';
      
        //$pdf->fillForm('/home/danytlaw/Downloads/data.xfdf');
        //$pdf->flatten();      

    
        
        //return response()->download($pdf);
        
            // Create PDF
        
        
        $pdf = new Pdf($path, [
            'command' => '/app/vendor/pdftk/bin/pdftk',
            //'command' => '/snap/pdftk/9/usr/bin/pdftk',
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
        if (!$pdf->saveAs('/app/storage/app/public/pdf/filled2.pdf')) {
            $error = $pdf->getError();
            echo $error;
        }
    }
}

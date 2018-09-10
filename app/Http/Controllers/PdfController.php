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
        $path = storage_path('app/public/pdf/my_converted.pdf');
      
        //$pdf->fillForm('/home/danytlaw/Downloads/data.xfdf');
        //$pdf->flatten();      

    
        
        //return response()->download($pdf);
        
            // Create PDF
        
            
        //$xfdf = new XfdfFile(['name' => 'Jürgen мирано']);
        //$xfdf->saveAs(storage_path('app/public/data.xfdf'));

        $pdf = new Pdf($path, [
            'command' => base_path('vendor/pdftk/bin/pdftk'),
            //'command' => '/snap/pdftk/9/usr/bin/pdftk',
            'useExec' => true
        ]);
        
        $pdf->fillForm([
                'Text9' => 'Herzog',
                'Text10' => 'Daniel'
            ])
        ->needAppearances()
        ->saveAs(storage_path('app/public/pdf/filled2.pdf'));
        
        // Check for errors
        if (!$pdf->saveAs('filled2.pdf')) {
            $error = $pdf->getError();
            echo $error;
        }
    }
}

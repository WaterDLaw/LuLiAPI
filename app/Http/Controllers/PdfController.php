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
        
        // dump values
        $name = "Herzog";
        $vorname = "Daniel";
        
        $temp_file = tempnam(sys_get_temp_dir(), 'Tux');

        info ($temp_file);

        // Fill form with data array
        $path = storage_path('app/public/pdf/my_converted.pdf');
        info($path);
        $pdf = new Pdf('/home/danytlaw/Downloads/my_converted.pdf');
        
        $xfdf = new XfdfFile(['Text9' => 'Daniel']);
        $xfdf->saveAs('/home/danytlaw/Downloads/data.xfdf');

        //$pdf->fillForm('/home/danytlaw/Downloads/data.xfdf');
        //$pdf->flatten();      

            
        if (!$pdf->saveAs('/home/danytlaw/Downloads/filled.pdf')) {
            $error = $pdf->getError();
            info($error);
        }
        
        //return response()->download($pdf);
        
            // Create PDF
        
            
        //$xfdf = new XfdfFile(['name' => 'Jürgen мирано']);
        //$xfdf->saveAs(storage_path('app/public/data.xfdf'));
    }
}

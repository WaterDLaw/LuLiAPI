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

        $pdf = new Pdf('/app/storage/app/public/pdf/my_converted.pdf', [
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
        if (!$pdf->saveAs('/app/storage/app/public/pdf/filleder.pdf')) {
            $error = $pdf->getError();
            echo $error;
        }

        return response()->download(storage_path("app/public/pdf/filleder.pdf"));
    }
}

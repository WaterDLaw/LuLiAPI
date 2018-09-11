<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use mikehaertl\pdftk\Pdf;
use mikehaertl\pdftk\XfdfFile;
use mikehaertl\pdftk\FdfFile;
use App\Patient;
use Response;

class PdfController extends Controller
{
    //Verordnungsformular08_D

    public function getVerordnungsformular($id){

        $patient = Patient::find($id);
        
        //$path = '/app/storage/app/public/pdf/my_converted.pdf'
        $path = storage_path("app/public/pdf/my_converted.pdf");

        $pdf = new Pdf($path, [
            'command' => '/app/vendor/pdftk/bin/pdftk',
            //'command' => '/snap/pdftk/current/usr/bin/pdftk',
            'useExec' => true
        ]);
        
        echo $patient->name;

        //$data = $pdf->getDataFields();
        
        // Get data as string
        //echo $data;
        
        $name = $patient->name;
        $vorname = $patient->vorname;
        $strasse = $patient->strasse;
        $plzOrt = $patient->plz . " " .$patient->wohnort;
        $geb = $patient->geburtsdatum;
        $tel = $patient->telefon;
        $arbeitgeber = "";
        $firmaPlzOrt = "";
        $telFirma = "";
        $versicherer = "";
        $VersUnfallNr = "";
        
        $pdf->fillForm([
                'Text9' => $name,
                'Text10' => $vorname,
                'Text11' => $strasse,
                'Text12' => $plzOrt,
                'Text13' => $geb,
                'Text14' => $tel,
                'Text15' => $arbeitgeber,
                'Text16' => $firmaPlzOrt,
                'Text17' => $telFirma,
                'Text18' => $versicherer,
                'Text19' => $VersUnfallNr
            ])
        ->needAppearances();
        
        // Check for errors
        if (!$pdf->saveAs(storage_path("app/public/pdf/filleder.pdf"))) {
            $error = $pdf->getError();
            echo $error;
        }
        /*
        if (!$pdf->saveAs('/app/storage/app/public/pdf/filleder.pdf')) {
            $error = $pdf->getError();
            echo $error;
        }
        */
        return response()->download(storage_path("app/public/pdf/filleder.pdf"));
    }
}

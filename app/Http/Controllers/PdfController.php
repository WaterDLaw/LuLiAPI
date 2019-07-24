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


        $pdf = new Pdf('/app/storage/app/public/pdf/my_converted.pdf', [
            'command' => '/app/vendor/pdftk/bin/pdftk',
            'useExec' => true
        ]);
        
        $pdf->stamp('/app/storage/app/public/pdf/signaturetester.pdf')
           ->saveAs('/app/storage/app/public/pdf/stamp.pdf');
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
        


        // Add Signature to file
        // Stamp with another PDF (first page repeated)

        // Check for errors
        if (!$pdf->saveAs('/app/storage/app/public/pdf/filleder.pdf')) {
            $error = $pdf->getError();
            echo $error;
        }
        return response()->download('/app/storage/app/public/pdf/signaturetester.pdf');
    }
}

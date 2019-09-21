<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use mikehaertl\pdftk\Pdf;
use mikehaertl\pdftk\XfdfFile;
use mikehaertl\pdftk\FdfFile;
use App\Patient;
use Illuminate\Support\Facades\Storage;
use Response;
use Log;

class PdfController extends Controller
{
    //Verordnungsformular08_D

    public function getVerordnungsformular($id){

        $patient = Patient::find($id);


        $pdf = new Pdf('/app/storage/app/public/pdf/my_converted.pdf', [
            'command' => '/app/vendor/pdftk/bin/pdftk',
            'useExec' => true
        ]);
        Log::debug("TEEEEEEEEEEEST");
                
        try{
            $pdf->background('/app/storage/app/temp_signature_pdf/temp_signature.pdf');
        } catch (Exception $e){
            Log::error("Could not stamp pdf: " . $pdf->getError());
        }
        $pdf->saveAs('/app/storage/app/public/pdf/tempstamp.pdf');

        sleep(1);

        $stamppdf = new Pdf('/app/storage/app/public/pdf/tempstamp.pdf', [
            'command' => '/app/vendor/pdftk/bin/pdftk',
            'useExec' => true
        ]);

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
        
        $stamppdf->fillForm([
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
        if (!$stamppdf->saveAs('/app/storage/app/public/pdf/filleder.pdf')) {
            $error = $stamppdf->getError();
            Log::error ("Could not save pdf:" . $error);
        }
        Storage::delete('temp_signature.pdf');
        Storage::delete('tempstamp.pdf');
        return response()->download('/app/storage/app/public/pdf/filleder.pdf');
    }

    public function uploadTempSignature(Request $request)
    {
        // Store signature pdf in Storage
        $path = $request->file('signature')->storeAs('temp_signature_pdf', "temp_signature.pdf");
        sleep(5);
        

    }

    public function deleteTempSignature()
    {
        // Delete the file after the new one is created
        Storage::delete('temp_signature_pdf/temp_signature.pdf');
    }


    // Function to create the patientinformation formular
    public function getPatientFormular($id){

        // Find the Patient to get the data
        $patient = Patient::find($id);

        // Save the empty Pdf in the variable
        $pdf = new Pdf('/app/storage/app/public/pdf/patient_form.pdf', [
            'command' => '/app/vendor/pdftk/bin/pdftk',
            'useExec' => true
        ]);

        // Save all the information needed into variables for easier use
        $vorname = $patient->vorname;
        $name = $patient->name;
        $geb = $patient->geburtsdatum;
        
        $pdf->fillForm([
            'Name' => $name,
            'Vorname' => $vorname,
            'Geb.datum' => $geb
        ])
        ->needAppearances();

        if (!$pdf->saveAs('/app/storage/app/public/pdf/fillpatient.pdf')) {
            $error = $pdf->getError();
            Log::error ("Could not save patient pdf:" . $error);
        }else{
            return response()->download('/app/storage/app/public/pdf/fillpatient.pdf');
        }

    }
}

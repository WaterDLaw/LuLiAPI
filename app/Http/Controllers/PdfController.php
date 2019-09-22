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

        // Check the diagnoses and add them to a string
        $diagnoses_text = "";

        if($patient->chronisch_obstruktive_Lungenkrankheit){
            $diagnoses_text = $diagnoses_text . "Chronisch obstruktive Lungenkrankheit ";
        }elseif($patient->zystische_fibrose){
            $diagnoses_text = $diagnoses_text . "Zystische fibrose ";
        }elseif($patient->asthma_bronchiale){
            $diagnoses_text = $diagnoses_text . "Asthma Bronchiale ";
        }elseif($patient->interstitielle_lungenkrankheit){
            $diagnoses_text = $diagnoses_text . "Interstitielle Lungenkrankheit ";
        }elseif($patient->thoraxwand_thoraxmuskelerkrankung){
            $diagnoses_text = $diagnoses_text . "Thoraxwand Thoraxmuskelerkrankung ";
        }elseif($patient->andere_lungenkrankheit){
            $diagnoses_text = $diagnoses_text . "Andere Lungenkrankheit ";
        }elseif($patient->postoperative_lungenoperation){
            $diagnoses_text = $diagnoses_text . "Postoperative Lungenoperation ";
        }elseif($patient->funktionelle_atemstoerung){
            $diagnoses_text = $diagnoses_text . "Funktionelle Atemstörung ";
        }
        $diagnosen = $diagnoses_text;
        $pneumologe = $patient->pneumologist->anrede . " " . $patient->pneumologist->vorname . " " . $patient->pneumologist->name;
        $kurs = $patient->training->title;

        // Messwerte

        // Standard
        $groesse = $patient->messwerte->groesse_vor;
        $gewicht_vor = $patient->messwerte->gewicht_vor;
        $gewicht_nach = $patient->messwerte->gewicht_nach;
        $bmi_vor = $patient->messwerte->bmi_vor;
        $bmi_nach = $patient->messwerte->bmi_nach;

        // Spirometrie
        $fev1l_vor = $patient->messwerte->fev1l_vor;
        $fev1l_nach = $patient->messwerte->fev1l_nach;
        $fev1soll_vor = $patient->messwerte->fev1soll_vor;
        $fev1soll_nach = $patient->messwerte->fev1soll_nach;
        $fvc_vor = $patient->messwerte->fvc_vor;
        $fvc_nach = $patient->messwerte->fvc_nach;
        $rv_vor = $patient->messwerte->rv_vor;
        $rv_nach = $patient->messwerte->rv_nach;
        $tlc_vor = $patient->messwerte->tlc_vor;
        $tlc_nach = $patient->messwerte->tlc_nach;
        $fev1_fvc_vor = $patient->messwerte->fev1_fvc_vor;
        $fev1_fvc_nach = $patient->messwerte->fev1_fvc_nach;
        $rv_tlc_vor = $patient->messwerte->rv_tlc_vor;
        $rv_tlc_nach = $patient->messwerte->rv_tlc_nach;

        // Fill the pdf form
        $pdf->fillForm([
            'Name' => $name,
            'Vorname' => $vorname,
            'Geb.datum' => $geb,
            'Diagnose(n)' => $diagnoses_text,
            'Pneumolog/in' => $pneumologe,
            'Kursnr' => $kurs,
            'VORGrösse m' => $groesse,
            'VORGewicht kg' => $gewicht_vor,
            'NACHGewicht kg' => $gewicht_nach,
            'VORBMI kgm2' => $bmi_vor,
            'NACHBMI kgm2' => $bmi_nach,
            'VORFEV1 l' => $fev1l_vor,
            'NACHFEV1 l' => $fev1l_nach,
            'VORFEV1 Soll' => $fev1soll_vor,
            'NACHFEV1 Soll' => $fev1soll_nach,
            'VORFVC l' => $fvc_vor,
            'NACHFVC l' => $fvc_nach,
            'VORFEV1FVC' => $fev1_fvc_vor,
            'NACHFEV1FVC' => $fev1_fvc_nach,
            'VORRVTLC' => $rv_tlc_vor,
            'NACHRVTLC' => $rv_tlc_nach
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

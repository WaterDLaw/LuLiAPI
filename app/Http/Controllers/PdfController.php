<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use mikehaertl\pdftk\Pdf;
use mikehaertl\pdftk\XfdfFile;
use mikehaertl\pdftk\FdfFile;
use App\Patient;
use App\CrqSas;
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
        Log::debug("CRQ GET START");

        // Find the Crqsas for the patient
        $exists = $patient->crq_sas()->where('erledigt', 'after')->exists();
        if($exists){
            Log::debug("CRQ AFTER EXISTS");
            $crq_sas = $patient->crq_sas()->where('erledigt', 'after')->get();
            $crq_sas_after = $crq_sas[0];
        }
        else{
            $crq_sas_after = false;
        }

        $exists = $patient->crq_sas()->where('erledigt', 'before')->exists();
        if($exists){
            Log::debug("CRQ BEFORE EXISTS");
            $crq_sas = $patient->crq_sas()->where('erledigt', 'before')->get();
            $crq_sas_before = $crq_sas[0];
        }
        else{
            $crq_sas_before = false;
        }

        // Find the CAT for the patient
        $exists = $patient->cats()->where('erledigt', 'before')->exists();
        if($exists){

            $cat_b = $patient->cats()->where('erledigt', 'before')->get();
            $cat_before = $cat_b[0];
        }
        else{

            $cat_before = false;
        }


        $exists = $patient->cats()->where('erledigt', 'after')->exists();
        if($exists){
   
            $cat_a = $patient->cats()->where('erledigt', 'after')->get();
            $cat_after = $cat_a[0];
        }
        else{
      
            $cat_after= false;
        }

       
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
        $fev1soll_vor = (float)$patient->messwerte->fev1soll_vor;
        $fev1soll_nach = (float)$patient->messwerte->fev1soll_nach;
        $fvc_vor = $patient->messwerte->fvc_vor;
        $fvc_nach = $patient->messwerte->fvc_nach;
        $rv_vor = $patient->messwerte->rv_vor;
        $rv_nach = $patient->messwerte->rv_nach;
        $tlc_vor = $patient->messwerte->tlc_vor;
        $tlc_nach = $patient->messwerte->tlc_nach;
        $fev1_fvc_vor = (float)$patient->messwerte->fev1_fvc_vor;
        $fev1_fvc_nach = (float)$patient->messwerte->fev1_fvc_nach;
        $rv_tlc_vor = (float)$patient->messwerte->rv_tlc_vor;
        $rv_tlc_nach = (float)$patient->messwerte->rv_tlc_nach;

        // Arterielle Blutgase
        $O2_Dosis_vor = $patient->messwerte->O2_Dosis_vor;
        $O2_Dosis_nach = $patient->messwerte->O2_Dosis_nach;
        $saO2_vor = (float)$patient->messwerte->saO2_vor;
        $saO2_nach = (float)$patient->messwerte->saO2_nach;
        $phwert_vor = $patient->messwerte->phwert_vor;
        $phwert_nach = $patient->messwerte->phwert_nach;
        $pO2_vor = $patient->messwerte->pO2_vor;
        $pO2_nach = $patient->messwerte->pO2_nach;
        $pC02_vor = $patient->messwerte->pC02_vor;
        $pC02_nach = $patient->messwerte->pC02_nach;
        $bicarbonat_vor = $patient->messwerte->bicarbonat_vor;
        $bicarbonat_nach = $patient->messwerte->bicarbonat_nach;

        // Belastungstest
        $max_leistungW_vor = $patient->messwerte->max_leistungW_vor;
        $max_leistungW_nach = $patient->messwerte->max_leistungW_nach;
        $max_leistungS_vor = (float)$patient->messwerte->max_leistungS_vor;
        $max_leistungS_nach = (float)$patient->messwerte->max_leistungS_nach;
        $vO2max_vor = $patient->messwerte->vO2max_vor;
        $vO2max_nach = $patient->messwerte->vO2max_nach;

        // 6-min gehtest
        $distanzM_vor = $patient->messwerte->distanzM_vor;
        $distanzM_nach = $patient->messwerte->distanzM_nach;
        $distanzS_vor = (float)$patient->messwerte->distanzS_vor;
        $distanzS_nach = (float)$patient->messwerte->distanzS_nach;
        $saO2min_vor = (float)$patient->messwerte->saO2min_vor;
        $saO2min_nach = (float)$patient->messwerte->saO2min_nach;

        // Dyspnoe
        $dyspnoe_vor = $patient->messwerte->dyspnoe_vor;
        $dyspnoe_nach = $patient->messwerte->dyspnoe_nach;



        // CRQ Fragebogen
        Log::debug($crq_sas_before);
        if($crq_sas_before){
            Log::debug("CRQ before tests");
            $crq_fatique_vor = $crq_sas_before->fatique;
            
            $crq_emotion_vor = $crq_sas_before->emotion;
            $crq_dyspnoe_vor = $crq_sas_before->dyspnoe;
            $crq_mastery_vor = $crq_sas_before->mastery;
        }else{
            $crq_fatique_vor = "";
            $crq_emotion_vor = "";
            $crq_dyspnoe_vor = "";
            $crq_mastery_vor = "";
        }
        Log::debug($crq_sas_after);
        if($crq_sas_after){
            Log::debug("CRQ after tests");
            $crq_fatique_nach = $crq_sas_after->fatique;
            $crq_emotion_nach = $crq_sas_after->emotion;     
            $crq_dyspnoe_nach = $crq_sas_after->dyspnoe;        
            $crq_mastery_nach = $crq_sas_after->mastery;
        }else{
            $crq_fatique_nach = "";
            $crq_emotion_nach = "";    
            $crq_dyspnoe_nach = "";        
            $crq_mastery_nach = ""; 
        }

        // Cat 
        if($cat_before){
            Log::debug("Cat before tests");
            $cat_score_before = $cat_before->gesamtpunktzahl;
        }else{
            $cat_score_before = "";
        }

        if($cat_after){
            Log::debug("Cat after tests");
            $cat_score_after = $cat_after->gesamtpunktzahl;
        }else{
            $cat_score_after = "";
        }

        // Bodescore

        $bodescore_before = $patient->messwerte->bodescore_vor;
        $bodescore_after = $patient->messwerte->bodescore_nach;

        // Calculate differenzes
        $diff_fev1 = $fev1l_nach - $fev1l_vor;
        $diff_fev1soll = $fev1soll_nach - $fev1soll_vor;

        $diff_saO2 = $saO2_nach - $saO2_vor;

        $diff_max_leistungW = $max_leistungW_nach - $max_leistungW_vor;
        $diff_max_leistungS = $max_leistungS_nach - $max_leistungS_vor;

        $diff_distanzM = $distanzM_nach - $distanzM_vor;
        $diff_distanzS = $distanzS_nach - $distanzS_vor;

        $diff_dyspnoe_mmrc = $dyspnoe_nach - $dyspnoe_vor;

        $diff_crq_dyspnoe = $crq_dyspnoe_nach - $crq_dyspnoe_vor;
        $diff_crq_fatique = $crq_fatique_nach - $crq_fatique_vor;
        $diff_crq_emotion = $crq_emotion_nach - $crq_emotion_vor;
        $diff_crq_mastery = $crq_mastery_nach - $crq_mastery_vor;

        $diff_cat = $cat_score_after - $cat_score_before;

        $diff_bodescore = $bodescore_after - $bodescore_before;

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
            'NACHRVTLC' => $rv_tlc_nach,
            'VORO2Dosis lmin' => $O2_Dosis_vor,
            'NACHO2Dosis lmin' => $O2_Dosis_nach,
            'VORSaO2' => $saO2_vor * 100,
            'NACHSaO2' => $saO2_nach* 100,
            'VORpH' => $phwert_vor,
            'NACHpH' => $phwert_nach,
            'VORpO2 mmHg' => $pO2_vor,
            'NACHpO2 mmHg' => $pO2_nach,
            'VORpCO2 mmHg' => $pC02_vor,
            'NACHpCO2 mmHg' => $pC02_nach,
            'VORBicarbonat mmoll' => $bicarbonat_vor,
            'NACHBicarbonat mmoll' => $bicarbonat_nach,
            'VORMax Leistung W' => $max_leistungW_vor,
            'NACHMax Leistung W' => $max_leistungW_nach,
            'VORMax Leistung Soll' => $max_leistungS_vor,
            'NACHMax Leistung Soll' => $max_leistungS_nach,
            'VORVO2max lminkg' => $vO2max_vor,
            'NACHVO2max lminkg' => $vO2max_nach,
            'VORDistanz Meter m' => $distanzM_vor,
            'NACHDistanz Meter m' => $distanzM_nach,
            'VORDistanz Meter Soll' => $distanzS_vor,
            'NACHDistanz Meter Soll' => $distanzS_nach,
            'VORSaO2min' => $saO2min_vor *100,
            'NACHSaO2min' => $saO2min_nach*100,
            'VORDyspnoe MMRCScore 04' => $dyspnoe_vor,
            'NACHDyspnoe MMRCScore 04' => $dyspnoe_nach,
            'VORDyspnoe' => $crq_dyspnoe_vor,
            'NACHDyspnoe' => $crq_dyspnoe_nach,
            'VORMüdigkeit' => $crq_fatique_vor,
            'NACHMüdigkeit' => $crq_fatique_nach,
            'VORGefühlslage' => $crq_emotion_vor,
            'NACHGefühlslage' => $crq_fatique_nach,
            'VORBewältigung' => $crq_mastery_vor,
            'NACHBewältigung' => $crq_mastery_nach,
            'VOR_CAT' => $cat_score_before,
            'NACH_CAT' => $cat_score_after,
            'VOR_BODEScore' => $bodescore_before,
            'NACH_BODEScore' => $bodescore_after,
            'DIFFERENZFEV1_L' => $diff_fev1,
            'DIFFERENZFEV1Soll' => $diff_fev1soll,
            'DIFFERENZSaO2' => $diff_saO2 *100,
            'DIFFERENZMax Leistung W' => $diff_max_leistungW,
            'DIFFERENZMax Leistung Soll' => $diff_max_leistungS,
            'DIFFERENZDistanz Meter m' => $diff_distanzM,
            'DIFFERENZDistanz Meter Soll' => $diff_distanzS,
            'DIFFERENZDyspnoe MMRCScore 04' => $diff_dyspnoe_mmrc,
            'DIFFERENZDyspnoe' => $diff_crq_dyspnoe,
            'DIFFERENZMüdigkeit' => $diff_crq_fatique,
            'DIFFERENZGefühlslage' => $diff_crq_emotion,
            'DIFFERENZBewältigung' => $diff_crq_mastery,
            'DIFFERENZ_CAT' => $diff_cat,
            'DIFFERENZ_BODEScore' => $diff_bodescore


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

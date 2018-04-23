<?php

namespace App\Http\Controllers;

use App\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $patients = Patient::all();

        return $patients;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        info('Store request.');
        //
/**
 * 
 */
  //      $patient->vorname = $request->input('vorname');
  //      $patient->name = $request->input('name');
  //      $patient->email = $request->input('email');
  //      $patient->geburtsdatum = $request->input('geburtsdatum');
  //      $patient->groesse = $request->input('groesse');
  //      $patient->geschlecht = $request->input('geschlecht');
  //      $patient->sprache = $request->input('sprache');
  //      $patient->telefon = $request->input('telefon');
  //      $patient->strasse = $request->input('strasse');
  //      $patient->plz = $request->input('plz');
  //      $patient->wohnort = $request->input('wohnort');
  //      $patient->chronisch_obstruktive_Lungenkrankheitame = $request->input('chronisch_obstruktive_Lungenkrankheit');
  //      $patient->zystische_fibroseme = $request->input('zystische_fibrose');
  //      $patient->asthma_bronchiale = $request->input('asthma_bronchiale');
  //      $patient->interstitielle_lungenkrankheit = $request->input('interstitielle_lungenkrankheit');
  //      $patient->thoraxwand_thoraxmuskelerkrankung = $request->input('vothoraxwand_thoraxmuskelerkrankungrname');
  //      $patient->andere_lungenkrankheit = $request->input('andere_lungenkrankheit');
  //      $patient->postoperative_lungenoperation = $request->input('postoperative_lungenoperation');
  //      $patient->funktionelle_atemstörung = $request->input('funktionelle_atemstörung');
  //      $patient->diagnose_details = $request->input('diagnose_details');
  //      $patient->bemerkungen = $request->input('bemerkungen');

  //      $patient->save();

  //      return 'Patient wurde erfolgreich erfasst';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $patient = Patient::find($id);

        return $patient;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idt)
    {
        //
        $patient = Patient::find($id);
        
        $patient->vorname = $request->input('vorname');
        $patient->name = $request->input('name');
        $patient->email = $request->input('email');
        $patient->geburtsdatum = $request->input('geburtsdatum');
        $patient->groesse = $request->input('groesse');
        $patient->geschlecht = $request->input('geschlecht');
        $patient->sprache = $request->input('sprache');
        $patient->telefon = $request->input('telefon');
        $patient->strasse = $request->input('strasse');
        $patient->plz = $request->input('plz');
        $patient->wohnort = $request->input('wohnort');
        $patient->chronisch_obstruktive_Lungenkrankheitame = $request->input('chronisch_obstruktive_Lungenkrankheit');
        $patient->zystische_fibroseme = $request->input('zystische_fibrose');
        $patient->asthma_bronchiale = $request->input('asthma_bronchiale');
        $patient->interstitielle_lungenkrankheit = $request->input('interstitielle_lungenkrankheit');
        $patient->thoraxwand_thoraxmuskelerkrankung = $request->input('vothoraxwand_thoraxmuskelerkrankungrname');
        $patient->andere_lungenkrankheit = $request->input('andere_lungenkrankheit');
        $patient->postoperative_lungenoperation = $request->input('postoperative_lungenoperation');
        $patient->funktionelle_atemstörung = $request->input('funktionelle_atemstörung');
        $patient->diagnose_details = $request->input('diagnose_details');
        $patient->bemerkungen = $request->input('bemerkungen');

        $patient->save();

        return 'Patient wurde erfolgreich bearbeitet';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $patient = Patient::find($request->input('$id'));

        $patient->delete();

        return 'Patient wurde erfolgreich gelöscht';
    }
}

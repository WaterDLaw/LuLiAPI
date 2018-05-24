<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Training;
use Illuminate\Http\Request;

class PatientController extends Controller
{

    /**
     * 
     * Constructor
     * 
     * @return void
     * 
     */

    public function __construct()
    {
        // Adds the JWT Auth Middleware to patients
        $this->middleware('jwt.auth');
    }

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

        return Patient::create($request->all());
        //

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
    public function update(Request $request)
    {
        //
        info('Update request.');
        $patient = Patient::findOrFail($request->id);
        $patient->update($request->all());


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

    /**
     * Add the Training_id to the patient.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function addTraining(Request $request){
    
        info('add Training.');

        $patient = Patient::find($request->patient['id']);
        $training = Training::find($request->training['id']);

        $patient->training()->associate($training);

        $patient->save();
        
    }

    // Checks if there is a Feedback and returns the feedback if there is one else return false
    public function hasFeedback($id){
 
        info('check Feedback');
        info($id);
        $exists = Patient::find($id)->arp_feedback()->exists();
        if($exists){
            info('exists');
            $arp_fragebogen = Patient::find($id)->arp_feedback()->get();
            info($arp_fragebogen);
            $return_value = $arp_fragebogen;
        }
        else{
            info('does not exist');
            $return_value = 'false';
        }
       return $return_value;
    }

    // Get feedback over the patient relation
    public function getFeedback($id){

        $feedback = Patient::find($id)->arp_feedback()->first();
        info($feedback);

        return $feedback;
    }

    // Checks if there is a Crqsas and returns the Crqsas if there is one else return false
    public function hasCrqsas($id){
        info('check crqsas');
        info($id);
        $exists = Patient::find($id)->crq_sas()->exists();
        if($exists){
            info('exists');
            $crq_sas = Patient::find($id)->crq_sas()->get();
            $return_value = $crq_sas;
        }
        else{
            info('does not exist');
            $return_value = 'false';
        }
       return $return_value;
    }

    // Get the Crqsas over the patient relation
    public function getCrqsas($id){

        $crqsas = Patient::find($id)->crq_sas()->first();
        info($crqsas);

        return $crqsas;
    }

     // Checks if there is a Cat and returns the Cat if there is one else return false
     public function hasCat($id){
        info('check crqsas');
        info($id);
        $exists = Patient::find($id)->cats()->exists();
        if($exists){
            info('exists');
            $cat = Patient::find($id)->cats()->get();
            $return_value = $cat;
        }
        else{
            info('does not exist');
            $return_value = 'false';
        }
       return $return_value;
    }

    // Get the Cat over the patient relation
    public function getCat($id){

        $cat = Patient::find($id)->cats()->first();
        info($cat);

        return $cat;
    }

// Checks if there is a Gehtest and returns the Gehtest if there is one else return false
public function hasGehtest($id){
    info('check gehtest');
    info($id);
    $exists = Patient::find($id)->gehtest()->exists();
    if($exists){
        info('exists');
        $gehtest = Patient::find($id)->gehtest()->get();
        $return_value = $gehtest;
    }
    else{
        info('does not exist');
        $return_value = 'false';
    }
   return $return_value;
}

// Get the Gehtest over the patient relation
public function getGehtest($id){

    $gehtest = Patient::find($id)->gehtest()->first();
    info($gehtest);

    return $gehtest;
}

}

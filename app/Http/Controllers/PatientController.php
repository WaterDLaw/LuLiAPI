<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Training;
use App\Pneumologist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewPatient;
use App\Mail\NewStatus;
use Symfony\Component\HttpFoundation\Response;

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
        info($request->patient);
        $patient = new Patient($request->patient);
 
        //Before anything is saved make sure that the training is not full in any way
        if($request->trainingAdd != 0){

            $training1 = Training::find($request->trainingAdd);

            //check if the training is not full
            //check if the monthly is not full
            $participants = $training1->patients()->get();
            info("patients");
            info($participants->count());
            $dt = strtotime($training1['start']);
            $newdt = date("Y-m-d", strtotime("-1 month", $dt));
            info($newdt);
            $newmonth = date("m",strtotime($newdt));
            $newyear = date("Y",strtotime($newdt));
            info($newmonth);
            info($newyear);
            $training2 = Training::whereMonth('start', $newmonth)->whereYear('start', $newyear)->first();
            info($training2);
            $patients2 = $training2->patients()->get();
            info($patients2);
            info("patients2");
            info($patients2->count());
            //Training3
            $dt = strtotime($training1['start']);
            $newdt = date("Y-m-d", strtotime("-2 month", $dt));
            info($newdt);
            $newmonth = date("m",strtotime($newdt));
            $newyear = date("Y",strtotime($newdt));
            info($newmonth);
            info($newyear);
    
            $training3 = Training::whereMonth('start', $newmonth)->whereYear('start', $newyear)->first();
            info($training3);
            $patients3 = $training3->patients()->get();
            info($patients3);
            info("patients3");
            info($patients3->count());
            $allParticipants = $participants->count() + $patients2->count() + $patients3->count();
            info($allParticipants);
            if($training1->max_new > $participants->count()){
                $max_new = true;
                $r_new = "true";
                info("New True");
            }else{
                $max_new = false;
                $r_new = "false";
                info("New False");
            }
            
            if($training1->max_anzahl > $allParticipants){
                $max_anzahl = true;
                $r_anzahl = "true";
                info("Max True");
            }else{
                $max_anzahl = false;
                $r_anzahl ="false";
                info("Max False");
            }
            
            if($max_new && $max_anzahl){
                $pneumologist = Pneumologist::find($request->patient['pneumologist_id']);

                $patient->pneumologist()->associate($pneumologist);
                $patient->save();
        
                //After the Patient is saved make sure it gets added to the correct training
                info($request->trainingAdd);
                if($request->trainingAdd != 0){
                    $training = Training::find($request->trainingAdd);
        
                    $patient->training()->associate($training);
            
                    $patient->save();
                }
        
                //send email Petra.Vonmoos@lungenliga-so.ch
                //Mail::to('danytlaw.dev@gmail.com')->send(new newPatient($patient, $pneumologist, $training));
                
                //
                return $patient;
                $message = "success";
            }else{
                $message = "failure";
                return json_encode([$r_anzahl,$r_new]);
            }
    

        }else{
            $pneumologist = Pneumologist::find($request->patient['pneumologist_id']);

            $patient->pneumologist()->associate($pneumologist);
            $patient->save();
    
            //After the Patient is saved make sure it gets added to the correct training
            info($request->trainingAdd);
            if($request->trainingAdd != 0){
                $training = Training::find($request->trainingAdd);
    
                $patient->training()->associate($training1);
        
                $patient->save();
            }
    
            //send email Petra.Vonmoos@lungenliga-so.ch
            //Mail::to('danytlaw.dev@gmail.com')->send(new newPatient($patient, $pneumologist, $training1));
            
            //
            return $patient;
        }


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
        info($request->status);
        info($request->abschlussDate);
        $after = $request->status;
        $patient = Patient::findOrFail($request->id);
        $before = $patient->status;
        $patient->update($request->all());
        $pneumologist = Pneumologist::find($request->pneumologist_id);

        info($patient->status);

        $patient->pneumologist()->associate($pneumologist);
        $patient->save();

        // check update if status changed
        if($before != $after){

            //send email
            Mail::to('danytlaw.dev@gmail.com')->send(new newStatus($patient, $pneumologist));

        }

        
    }

    /**
     * Remove the specified resource from storage.
     *ß
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $patient = Patient::find($id);

        $patient->delete();

        return 'deleted';
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
    

        $patient = Patient::find($request->patient['id']);
        $training1 = Training::find($request->training['id']);

        //check if the training is not full
        //check if the monthly is not full
        $participants = $training1->patients()->get();
        info("patients");
        info($participants->count());
        $dt = strtotime($training1['start']);
        $newdt = date("Y-m-d", strtotime("-1 month", $dt));
        info($newdt);
        $newmonth = date("m",strtotime($newdt));
        $newyear = date("Y",strtotime($newdt));
        info($newmonth);
        info($newyear);
        $training2 = Training::whereMonth('start', $newmonth)->whereYear('start', $newyear)->first();
        info($training2);
        $patients2 = $training2->patients()->get();
        info($patients2);
        info("patients2");
        info($patients2->count());
        //Training3
        $dt = strtotime($training1['start']);
        $newdt = date("Y-m-d", strtotime("-2 month", $dt));
        info($newdt);
        $newmonth = date("m",strtotime($newdt));
        $newyear = date("Y",strtotime($newdt));
        info($newmonth);
        info($newyear);

        $training3 = Training::whereMonth('start', $newmonth)->whereYear('start', $newyear)->first();
        info($training3);
        $patients3 = $training3->patients()->get();
        info($patients3);
        info("patients3");
        info($patients3->count());
        $allParticipants = $participants->count() + $patients2->count() + $patients3->count();
        info($allParticipants);
        if($training1->max_new > $participants->count()){
            $max_new = true;
            info("New True");
        }else{
            $max_new = false;
            info("New False");
        }
        
        if($training1->max_anzahl > $allParticipants){
            $max_anzahl = true;
            info("Max True");
        }else{
            $max_anzahl = false;
            info("Max False");
        }
        
        if($max_new && $max_anzahl){
            $patient->training()->associate($training1);

            $patient->save();
            $message = "success";
        }else{
            $message = "failure";
        }

        return json_encode([$max_anzahl,$max_new]);
        
    }

    // Checks if there is a Feedback and returns the feedback if there is one else return false
    public function hasFeedback($id){
 

        $exists = Patient::find($id)->arp_feedback()->exists();
        if($exists){
  
            $arp_fragebogen = Patient::find($id)->arp_feedback()->get();
      
            $return_value = $arp_fragebogen;
        }
        else{
      
            $return_value = 'false';
        }
       return $return_value;

    }

    // Get feedback over the patient relation
    public function getFeedback($id){

        $feedback = Patient::find($id)->arp_feedback()->first();


        return $feedback;
    }

    // Checks if there is a Crqsas and returns the Crqsas if there is one else return false
    public function hasCrqsasBefore($id){

        $exists = Patient::find($id)->crq_sas()->where('erledigt', 'before')->exists();
        if($exists){
         
            $crq_sas = Patient::find($id)->crq_sas()->where('erledigt', 'before')->get();
            $return_value = $crq_sas;
        }
        else{
    
            $return_value = 'false';
        }
       return $return_value;
    }

    public function hasCrqsasAfter($id){

        $exists = Patient::find($id)->crq_sas()->where('erledigt', 'after')->exists();
        if($exists){
       
            $crq_sas = Patient::find($id)->crq_sas()->where('erledigt', 'after')->get();
            $return_value = $crq_sas;
        }
        else{
        
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
     public function hasCatBefore($id){

        $exists = Patient::find($id)->cats()->where('erledigt', 'before')->exists();
        if($exists){

            $cat = Patient::find($id)->cats()->where('erledigt', 'before')->get();
            $return_value = $cat;
        }
        else{

            $return_value = 'false';
        }
       return $return_value;
    }

    public function hasCatAfter($id){

        $exists = Patient::find($id)->cats()->where('erledigt', 'after')->exists();
        if($exists){
   
            $cat = Patient::find($id)->cats()->where('erledigt', 'after')->get();
            $return_value = $cat;
        }
        else{
      
            $return_value = 'false';
        }
       return $return_value;
    }

    // Get the Cat over the patient relation
    public function getCat($id){

        $cat = Patient::find($id)->cats()->first();
   

        return $cat;
    }

// Checks if there is a Gehtest (Before and After) and returns the Gehtest if there is one else return false
public function hasGehtestBefore($id){

    $exists = Patient::find($id)->gehtest()->where('erledigt', 'before')->exists();
    if($exists){
   
        $gehtest = Patient::find($id)->gehtest()->where('erledigt', 'before')->get();
        $return_value = $gehtest;
    }
    else{
       
        $return_value = 'false';
    }
   return $return_value;
}

public function hasGehtestAfter($id){

    $exists = Patient::find($id)->gehtest()->where('erledigt', 'after')->exists();
    if($exists){
    
        $gehtest = Patient::find($id)->gehtest()->where('erledigt', 'after')->get();
        $return_value = $gehtest;
    }
    else{
    
        $return_value = 'false';
    }
   return $return_value;
}

// Get the Gehtest over the patient relation
public function getGehtest($id){

    $gehtest = Patient::find($id)->gehtest()->first();


    return $gehtest;
}

}

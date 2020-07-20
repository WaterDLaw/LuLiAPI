<?php

namespace App\Http\Controllers;

use DB;
use App\Training;
use App\Patient;
use Illuminate\Http\Request;

class TrainingController extends Controller
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
        // Adds the JWT Auth Middleware to trainings
        $this->middleware('jwt.auth',['except' => ['getCalendar', 'index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $training = Training::all();

        return $training;
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

        return Training::create($request->all());
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Training
     */
    public function show($id)
    {
        //
        $training = Training::find($id);

        return $training;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function edit(Training $training)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        info('Update request.');
        $training = Training::findOrFail($request->id);
        $training->update($request->all());


        return $training;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Training  $training
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $training = Training::find($id);

        // Set all patients foreign key to null
        $patients = Patient::where('training_id', '=', $id);
        $patients->update(['training_id' => null]);
        $training->delete();

        return 'Training wurde erfolgreich gelöscht';
    }

    public function getParticipants($id){
        $allPatients= [];
        info('Get Participatns');
        //Training1
        $training1 = Training::find($id);
        info($training1['start']);
        $patients1 = $training1->patients()
            ->leftJoin('pneumologists', 'pneumologists.id', '=', 'patients.pneumologist_id')
            ->select('patients.*','pneumologists.name as pneumologistName', 'pneumologists.vorname as pneumologistVorname')
            ->get();
        info($patients1);

        
        //Training2
        $dt = strtotime($training1['start']);
        $newdt = date("Y-m-d", strtotime("+1 month", $dt));
        info($newdt);
        $newmonth = date("m",strtotime($newdt));
        $newyear = date("Y",strtotime($newdt));
        info($newmonth);
        info($newyear);
        $training2 = Training::whereMonth('start', $newmonth)->whereYear('start', $newyear)->first();
        info($training2);
        $patients2 = $training2->patients()
        ->leftJoin('pneumologists', 'pneumologists.id', '=', 'patients.pneumologist_id')
        ->select('patients.*','pneumologists.name as pneumologistName', 'pneumologists.vorname as pneumologistVorname')
        ->get();
        info($patients2);

        //Training3
        $dt = strtotime($training1['start']);
        $newdt = date("Y-m-d", strtotime("+2 month", $dt));
        info($newdt);
        $newmonth = date("m",strtotime($newdt));
        $newyear = date("Y",strtotime($newdt));
        info($newmonth);
        info($newyear);

        $training3 = Training::whereMonth('start', $newmonth)->whereYear('start', $newyear)->first();
        info($training3);
        $patients3 = $training3->patients()
        ->leftJoin('pneumologists', 'pneumologists.id', '=', 'patients.pneumologist_id')
        ->select('patients.*','pneumologists.name as pneumologistName', 'pneumologists.vorname as pneumologistVorname')
        ->get();
        info($patients3);

        //check if the array are not null before merge
        
        $allPatients = json_encode(array_merge(json_decode($patients1,true), json_decode($patients2,true),json_decode($patients3,true))); 
  
        info($allPatients);

        return $allPatients;
        
        //return $patients1;

    }

    public function getCalendar(){
        info('Get all Participants for the calendar');

        $trainings = DB::table('trainings')
            ->join('patients', 'trainings.id', '=', 'patients.training_id')
            ->get();

        info($trainings);

        return $trainings;

    }

}

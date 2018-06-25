<?php

namespace App\Http\Controllers;

use DB;
use App\Training;
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
        $this->middleware('jwt.auth',['except' => ['getCalendar']]);
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


        return 'Training wurde erfolgreich bearbeitet';
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

        $training->delete();

        return 'Training wurde erfolgreich gelöscht';
    }

    public function getParticipants($id){
        info('Get Participatns');
        $patients = Training::find($id)->patients()->get();
        info($patients);
        return $patients;

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

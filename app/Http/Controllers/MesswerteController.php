<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Messwerte;
use App\Patient;

class MesswerteController extends Controller
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
        $messwerte = Messwerte::all();

        return $messwerte;
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
        info($request);
        // get the id of the patient first to asign the foreign key
        $messwerte = new Messwerte;
        info($request[0]);
        $patient = Patient::find($request[0]);
        info($patient);
        $messwerte->patient()->associate($patient);
        $messwerte->save();


        return $messwerte;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\messwerte  $gehtest
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        info($id);
        $messwerte = Messwerte::where('patient_id', '=', $id)->get();
        info($messwerte);
        return $messwerte;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\messwerte  $messwerte
     * @return \Illuminate\Http\Response
     */
    public function edit(ArpFeedback $messwerte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\messwerte  $messwerte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        info('Update request.');
        info($request->id);
        info($request);
        $messwerte = Messwerte::find($request->id);
        $messwerte->update($request->all());
        return $messwerte;


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\messwerte  $messwerte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $messwerte = Messwerte::find($request->input('$id'));

        $messwerte->delete();

        return 'messwerte wurde erfolgreich gelöscht';
    }

}

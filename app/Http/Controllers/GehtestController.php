<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gehtest;
use App\Patient;

class GehtestController extends Controller
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
        $gehtest = Gehtest::all();

        return $gehtest;
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
        info($request->gehtest);
        // get the id of the patient first to asign the foreign key
        $gehtest = Gehtest::create($request->gehtest);

        $patient = Patient::find($request->patient_id);
        $gehtest->patient()->associate($patient);
        $gehtest->save();


        return $gehtest;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CrqSas  $gehtest
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $gehtest = Gehtest::find($id);
        info($gehtest);
        return $gehtest;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gehtest  $gehtest
     * @return \Illuminate\Http\Response
     */
    public function edit(ArpFeedback $gehtest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gehtest  $gehtest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        info('Update request.');
        info($request->gehtest['id']);
        $gehtest = Gehtest::findOrFail($request->gehtest['id']);
        $gehtest->update($request->gehtest);
        return $gehtest;


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gehtest  $gehtest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $gehtest = Gehtest::find($request->input('$id'));

        $gehtest->delete();

        return 'gehtest wurde erfolgreich gelöscht';
    }

}

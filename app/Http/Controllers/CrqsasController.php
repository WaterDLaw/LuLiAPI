<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CrqSas;
use App\Patient;

class CrqsasController extends Controller
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
        $crqsas = CrqSas::all();

        return $crqsas;
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
        info($request->crqsas);
        // get the id of the patient first to asign the foreign key
        $crqsas = CrqSas::create($request->crqsas);

        $patient = Patient::find($request->patient_id);
        $crqsas->patient()->associate($patient);
        $crqsas->save();


        return $crqsas;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CrqSas  $crqsas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $crqsas = CrqSas::find($id);
        return $crqsas;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CrqSas  $crqsas
     * @return \Illuminate\Http\Response
     */
    public function edit(ArpFeedback $crqsas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CrqSas  $crqsas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        info('Update request.');
        info($request->crqsas['id']);
        $crqsas = CrqSas::findOrFail($request->crqsas['id']);
        $crqsas->update($request->crqsas);
        return $crqsas;


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Crqsas  $Crqsas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $crqsas = Crqsas::find($request->input('$id'));

        $crqsas->delete();

        return 'Crqsas wurde erfolgreich gelöscht';
    }

}

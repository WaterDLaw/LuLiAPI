<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ArpFeedback;
use App\Patient;

class ArpFeedbackController extends Controller
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
        $arpfragebogen = ArpFeedback::all();

        return $arpfragebogen;
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
        info($request->feedback);
        // get the id of the patient first to asign the foreign key
        $arpfeedback = ArpFeedback::create($request->feedback);

        $patient = Patient::find($request->patient_id);
        $arpfeedback->patient()->associate($patient);
        $arpfeedback->save();


        return $arpfeedback;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ArpFeedback  $ArpFragebogen
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $arp_feedback = ArpFeedback::find($id);
        return $arp_feedback;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ArpFeedback  $ArpFeedback
     * @return \Illuminate\Http\Response
     */
    public function edit(ArpFeedback $arpfeedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ArpFeedback  $ArpFragebogen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        info('Update request.');
        info($request->feedback['id']);
        $arpfeedback = ArpFeedback::findOrFail($request->feedback['id']);
        $arpfeedback->update($request->feedback);
        return $arpfeedback;


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ArpFeedback  $ArpFeedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $arpfeedback = ArpFeedback::find($request->input('$id'));

        $arpfeedback->delete();

        return 'ArpFeedback wurde erfolgreich gelöscht';
    }

}

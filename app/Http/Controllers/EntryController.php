<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Patient;
use App\User;
use App\Entry;

class EntryController extends Controller
{

    public function __construct()
    {
        // Adds the JWT Auth Middleware to trainings
        $this->middleware('jwt.auth',['except' => ['getCalendar', 'index']]);
    }


    /**
     * Display a listing of the resourcs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Displaly all the entries of one patient
     * 
     * @param $int id
     * 
     */
    public function getEntries($id){

        info('Get Entries');
        info($id);
        $patient = Patient::find($id);
        info($patient);
        $entries = $patient->entry()->get();
        info($entries);
        return $entries;

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
        info('Store Entry.');
        
        // get the id of the patient first to asign the foreign key
        $entry = Entry::create($request->entry);

        $patient = Patient::find($request->patient_id);
        $user = User::find($request->user_id);
        info($user->email);
        // Set email of associated user
        $entry->author = $user->email;

        // Eloquent belongsTo method call
        $entry->patient()->associate($patient);
        $entry->user()->associate($user);

        $entry->save();

        return $entry;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $entry = Entry::find($id);

        return $entry;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

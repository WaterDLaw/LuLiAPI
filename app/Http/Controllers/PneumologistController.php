<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pneumologist;

class PneumologistController extends Controller
{

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
        $pneumologist = Pneumologist::all();

        return $pneumologist;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
 
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

        return Pneumologist::create($request->all());
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
        $pneumologist = Pneumologist::find($id);

        return $pneumologist;
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
        info('Update request.');
        $pneumologist = Pneumologist::findOrFail($request->id);
        $pneumologist->update($request->all());

        return $pneumologist;
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

    // Get all the Patients for the Pneumologist
    public function getPatients($id){
        info('Get Patients');
        $patients = Pneumologist::find($id)->patients()->get();
        info($patients);
        return $patients;

    }
}

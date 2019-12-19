<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pneumologist;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
        info($request->name);

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
        info($pneumologist->signature);

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
        info($request);
        $pneumologist = Pneumologist::findOrFail($request->id);
        $pneumologist->update($request->all());

       return $pneumologist;
    }

    public function uploadSignature(Request $request)
    {
        info("update signature");
        info($request->id);
        info($request->file);

        // Store image in Storage
        //$path = $request->file('signature')->store('signatures');

        // Store imagein in s3
        $path = Storage::disk('s3')->put('signatures', $request->file('signature'));
        info("hochgeladen in s3");
        info($path);
        // Store link to path in database
        $pneumologist = Pneumologist::findOrFail($request->id);
        $pneumologist->signature = $path;

        $pneumologist->save();
        
        return $pneumologist;
    }

    public function checkPassword(Request $request)
    {
        info("Start check signature");
        info($request);
        $pneumologist = Pneumologist::findOrFail($request->id);
        
        

        // Check the password
        if($pneumologist->password == $request->password){
            $check = "true";
        }else{
            $check = "false";
        }

        return $check;

    }

    public function getSignature($path)
    {
        info("paassst");
        
        $signature = Storage::disk('s3')->get('signatures/' . $path);

        return response($signature, 200)->header('Content-Type', 'image/jpeg');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete a pneumologist

        $pneumologist = Pneumologist::find($id);
        $pneumologist->delete();
        return 'deleted';
    }

    // Get all the Patients for the Pneumologist
    public function getPatients($id){
        info('Get Patients');
        $patients = Pneumologist::find($id)->patients()->get();
        info($patients);
        return $patients;

    }
}

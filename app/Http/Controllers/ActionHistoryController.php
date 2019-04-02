<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActionHistory;
use App\User;
class ActionHistoryController extends Controller
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
       $ActionHistory = ActionHistory::all();

       return $ActionHistory;
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
       info('Store Actionhistory entry.');
       info($request->historyEntry);
       // get the id of the patient first to asign the foreign key
       $ActionHistory = ActionHistory::create($request->historyEntry);

       $user = User::where('email',$request->email)->first();
       $ActionHistory->email = $request->email;
       $ActionHistory->user()->associate($user);
       $ActionHistory->save();


       return $ActionHistory;
   }

   /**
    * Display the specified resource.
    *
    * @param  \App\ActionHistory  $cat
    * @return \Illuminate\Http\Response
    */
   public function show($id)
   {
       //
       $ActionHistory = ActionHistory::find($id);
       return $ActionHistory;

   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\ActionHistory  $ActionHistory
    * @return \Illuminate\Http\Response
    */
   public function edit(ArpFeedback $ActionHistory)
   {
       //
   }

   public function update(Request $request)
   {
       //


   }

   public function destroy(Request $request)
   {

   }
}

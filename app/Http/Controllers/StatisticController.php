<?php

namespace App\Http\Controllers;

use DB;
use App\Patient;
use App\Training;
use Illuminate\Http\Request;

class StatisticController extends Controller
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

    public function getPatientsWithTrainings(){
        info('Get all Patients with Training Info');

        $patients = DB::table('patients')
            ->leftJoin('trainings', 'patients.training_id', '=', 'trainings.id')
            ->leftJoin('messwertes', 'patients.id', '=', 'messwertes.patient_id')
            ->join('cats as catsbefore', 'patients.id', '=', 'cats.patient_id')->where('cats.erledigt', 'before')
            ->join('cats as catsafter', 'patients.id', '=', 'cats.patient_id')->where('cats.erledigt', 'after')

            ->get();


        return $patients;
    }


}

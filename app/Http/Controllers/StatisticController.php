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
            ->leftJoin('crq_sas', 'pateints.id', '=', 'crq_sas.patient_id')
            ->leftJoin('cats', 'patients.id', '=', 'cats.patient_id')
            ->get();


        return $patients;
    }


}

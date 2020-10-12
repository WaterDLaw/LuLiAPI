<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewPatient;
use App\Mail\NewError;

class MailController extends Controller
{
    //

    public function newPatient(){
        $name = 'Dani';
        Mail::to('danytlaw.dev@gmail.com')->send(new newPatient($name));
        
        return 'Email was sent';
    }

    public function newError($message){
        info($message);

        Mail::to('danytlaw.dev@gmail.com')->send(new newError($message));

        return "true";
    }
}

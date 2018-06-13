<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{

    public function patient(){
        return $this->belongsTo('App\Patient');
    }

    //
    protected $fillable = [
        'patient_id',
        'gesamtpunktzahl',
        'erstellungsdatum',
        'frage_1',
        'frage_2', 
        'frage_3',
        'frage_4',
        'frage_5',
        'frage_6',
        'frage_7',
        'frage_8',
        'erledigt'
    ];
}

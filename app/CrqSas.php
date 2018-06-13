<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CrqSas extends Model
{

    public function patient(){
        return $this->belongsTo('App\Patient');
    }

    //
    protected $fillable = [
        'patient_id',
        'erstellungsdatum',
        'frage_1',
        'frage_2',
        'frage_3',
        'frage_4',
        'frage_5',
        'frage_6',
        'frage_7',
        'frage_8',
        'frage_9',
        'frage_10',
        'frage_11',
        'frage_12',
        'frage_13',
        'frage_14',
        'frage_15',
        'frage_16',
        'frage_17',
        'frage_18',
        'frage_19',
        'frage_20',
        'erledigt'
    ];
}

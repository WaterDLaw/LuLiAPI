<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gehtest extends Model
{

    public function patient(){
        return $this->belongsTo('App\Patient');
    }

    //
    protected $fillable = [
        'patient_id',
        'erstellungsdatum',
        'distanz',
        'erledigt'
    ];
}

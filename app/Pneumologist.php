<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pneumologist extends Model
{

    public function patients(){
        return $this->hasMany('App\Patient');
    }

    //
    protected $fillable = [
        'anrede',
        'vorname',
        'name',
        'signature'
    ];
}

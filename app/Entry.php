<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{

    public function patient(){
        return $this->belongsTo('App\Patient');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    //
    protected $fillable = [
        'id',
        'text',
        'title'
    ];
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActionHistory extends Model
{

    public function user(){
        return $this->belongsTo('App\User');
    }

    //
    protected $fillable = [
        'topic',
        'action'
    ];
}
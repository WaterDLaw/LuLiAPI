<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{

    public function patients(){
        return $this->hasMany('App\Patient');
    }

    //
    protected $fillable = [
        'title',
        'ort',
        'start', 
        'end',
        'montag_start',
        'montag_end',
        'dienstag_start',
        'dienstag_end',
        'mittwoch_start',
        'mittwoch_end',
        'donnerstag_start',
        'donnerstag_end',
        'freitag_start',
        'freitag_end',
        'samstag_start',
        'samstag_end',
        'sonntag_start',
        'sonntag_end',
        'CRQ_SAS_bogen',
        'SF_36_bogen',
        'CRDQ_bogen',
        'gehtest_bogen',
        'feedback_bogen',
        'COPD_bogen',
        'belegt',

    ];
}

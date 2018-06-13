<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    // Model relationship
    public function training(){
        return $this->belongsTo('App\Training');
    }

    // Model relationship
    public function arp_feedback(){
        return $this->hasMany('App\ArpFeedback');
    }

    // Model relationship
    public function crq_sas(){
        return $this->hasMany('App\CrqSas');
    }

    // Model relationship
    public function cats(){
        return $this->hasMany('App\Cat');
    }

    // Model relationship
    public function gehtest(){
        return $this->hasMany('App\Gehtest');
    }

    //
    protected $fillable = [
        'vorname',
        'name', 
        'email',
        'geburtsdatum',
        'groesse',
        'geschlecht',
        'sprache',
        'telefon',
        'strasse',
        'plz',
        'wohnort',
        'chronisch_obstruktive_Lungenkrankheit',
        'zystische_fibrose',
        'asthma_bronchiale',
        'interstitielle_lungenkrankheit',
        'thoraxwand_thoraxmuskelerkrankung',
        'andere_lungenkrankheit',
        'postoperative_lungenoperation',
        'funktionelle_atemstörung',
        'diagnose_details',
        'bemerkungen',
        'status'
    ];
}

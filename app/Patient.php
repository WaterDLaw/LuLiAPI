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

    // Model relationship
    public function entry(){
        return $this->hasMany('App\Entry');
    }

    // Model relationship
    public function pneumologist(){
        return $this->belongsTo('App\Pneumologist');
    }

    public function messwerte(){
        return $this->hasOne('App\Messwerte');
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
        'status',
        'rauchstatus',
        'pneumologen',
        'gewicht_before',
        'gewicht_after',
        'fevl_before',
        'fevl_after',
        'fevp_before',
        'fevp_after',
        'vkmaxl_before',
        'vkmaxl_after',
        'vkmaxp_before',
        'vkmaxp_after',
        'vo2max_before',
        'vo2max_after',
        'copdgold',
        'copdletter',
        'belastung',
        'sauerstoff_bei_belastung',
        'sao2',
        'Intervalltraining'
    ];
}

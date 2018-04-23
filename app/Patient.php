<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
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
    ];
}

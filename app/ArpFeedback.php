<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArpFeedback extends Model
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
        'frage_1_bemerkungen',
        'frage_2', 
        'frage_2_bemerkungen',
        'frage_3',
        'frage_3_bemerkungen',
        'frage_4_a',
        'frage_4_b',
        'frage_4_c',
        'frage_4_d',
        'frage_4_e',
        'frage_4_bemerkungen',
        'frage_5_a',
        'frage_5_b',
        'frage_5_c',
        'frage_5_d',
        'frage_5_e',
        'frage_5_f',
        'frage_5_g',
        'frage_5_h',
        'frage_5_i',
        'frage_5_j',
        'frage_5_k',
        'frage_5_l',
        'frage_5_m',
        'frage_5_n',
        'frage_5_o',
        'frage_5_bemerkungen',
        'frage_6_a',
        'frage_6_b',
        'frage_6_c',
        'frage_6_d',
        'frage_6_e',
        'frage_6_bemerkungen',
        'frage_7',
        'frage_7_bemerkungen',
        'frage_8',
        'frage_9',
        'frage_9_bemerkungen',
        'allgemein'

    ];
}

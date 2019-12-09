<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Messwerte extends Model
{

    public function patient(){
        return $this->belongsTo('App\Patient');
    }

    //
    protected $fillable = [
        'patient_id',
        'groesse_vor',
        'groesse_nach',
        'gewicht_vor',
        'gewicht_nach',
        'bmi_vor',
        'bmi_nach',
        'fev1l_vor',
        'fev1l_nach',
        'fev1soll_vor',
        'fev1soll_nach',
        'fvc_vor',
        'fvc_nach',
        'fev1_fvc_vor',
        'fev1_fvc_nach',
        'rv_vor',
        'rv_nach',
        'tlc_vor',
        'tlc_nach',
        'rv_tlc_vor',
        'rv_tlc_nach',
        'O2_Dosis_vor',
        'O2_Dosis_nach',
        'saO2_vor',
        'saO2_nach',
        'phwert_vor',
        'phwert_nach',
        'pO2_vor',
        'pO2_nach',
        'pC02_vor',
        'pC02_nach',
        'bicarbonat_vor',
        'bicarbonat_nach',
        'max_leistungW_vor',
        'max_leistungW_nach',
        'max_leistungS_vor',
        'max_leistungS_nach',
        'vO2max_vor',
        'vO2max_nach',
        'hfmax_vor',
        'hfmax_nach',
        'distanzM_vor',
        'distanzM_nach',
        'distanzS_vor',
        'distanzS_nach',
        'dyspnoe_vor',
        'dyspnoe_nach',
        'bodescore_vor',
        'bodescore_nach',
        'saO2min_vor',
        'saO2min_nach',
        'fvc_soll_vor',
        'fvc_soll_nach',
        'trainingspuls',
        'rr_syst_vor',
        'rr_syst_nach',
        'rr_diast_vor',
        'rr_diast_nach'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MrcAnalysis extends Model
{
    //
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }



    //  Properties
    protected $fillable = [
        'patient_id',
        'user_id',
        'creatinine_level',
        'gfr',
        'albumin_level',
    ];
}

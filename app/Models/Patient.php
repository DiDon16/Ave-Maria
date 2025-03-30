<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    public function medicalRecords()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public function mrcAnalyses()
    {
        return $this->hasMany(Analysis::class);
    }

    //  Properties
    protected $fillable = [
        'firstName',
        'lastName',
        'date_of_birth',
        'gender',
    ];
}

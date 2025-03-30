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
}

<?php

namespace App\Models;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }

    protected $fillable = [
        'name',
    ];
}

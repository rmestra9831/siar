<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sede;
use App\User;

class Program extends Model
{
    public function sedes()
    {
        return $this->belongsTo(Sede::class, 'sede_id');
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Sede;

class Program extends Model
{
    public function sedes()
    {
        return $this->belongsTo(Sede::class, 'id_sede');
    }
}

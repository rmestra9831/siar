<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Radicado;

class Motivo extends Model
{
    public function Radicados()
    {
        return $this->belongsToMany(Radicado::class);
    }
}

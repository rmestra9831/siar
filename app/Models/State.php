<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Radicado;

class State extends Model
{
    protected $fillable = ['radic_id','start','sent_dir','recived_dir','delegated','answered','redirection','answer_redirection','sent_to_check','aproved'];

    public function radicado()
    {
        return $this->belongsTo(Radicado::class);
    }
}

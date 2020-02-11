<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Radicado;

class State extends Model
{
    protected $fillable = ['radic_id','start','sent_dir','recived_dir','delegated','answered','redirection','answerCheck','sentAdmissions','sent_to_check','aproved'];

    public function radicado()
    {
        return $this->hasOne(Radicado::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\State;
use App\User;

class Radicado extends Model
{
    protected $fillable = ['consecutive','atention','origin_id','sede_id','program_id','first_name','last_name','origin_correo','origin_cel','type_reason','reason_id','affair','notes'];

    public function state()
    {
        return $this->hasOne(State::class);
    }

    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id');
    }

    public function delegateId(){
        return $this->belongsTo(User::class, 'delegate_id');
    }

    public function createById(){
        return $this->belongsTo(User::class, 'createBy_id');
    }
}

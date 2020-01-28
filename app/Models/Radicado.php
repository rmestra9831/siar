<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Radicado extends Model
{
    public function delegateId(){
    return $this->belongsTo(User::class, 'delegate_id');
    }

    public function createById(){
    return $this->belongsTo(User::class, 'createBy_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Sede extends Model
{
    public function user()
    {
        return $this->hasMany('App\User');
    }
}

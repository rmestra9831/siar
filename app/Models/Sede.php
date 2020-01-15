<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Program;
use App\User;

class Sede extends Model
{
    public function user()
    {
        return $this->hasMany('App\User');
    }
    public function programs()
    {
        return $this->hasMany(Program::class);
    }
}

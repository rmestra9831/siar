<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Program;
use App\User;

class Sede extends Model
{
    public function user()
    {
        return $this->hasMany(User::class);
    }
    public function programs()
    {
        return $this->HasMany(Program::class);
    }
}

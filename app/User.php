<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use App\Models\Program;
use App\Models\Sede;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;  

    public function role(): MorphToMany
    {
        return $this->morphedByMany(Role::class, 'model_has_role'
        );
    }
    public function sede()
    {
        return $this->belongsTo(Sede::class);
    }
    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'slug'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
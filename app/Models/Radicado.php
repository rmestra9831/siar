<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\State;
use App\Models\Radicado;
use App\Models\Origin;
use App\User;

class Radicado extends Model
{
    protected $fillable = ['consecutive','atention','origin_id','sede_id','program_id','first_name','last_name','origin_correo','origin_cel','type_reason','reason_id','affair','notes','slug','delegate_id','date_delegated','date_update_redirection'];

    public function state()
    {
        return $this->belongsTo(State::class, 'states_id');
    }
    
    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
    public function destination()
    {
        return $this->belongsTo(Program::class, 'destination_id');
    }
    public function sede()
    {
        return $this->belongsTo(Sede::class, 'sede_id');
    }

    public function delegateId(){
        return $this->belongsTo(User::class, 'delegate_id');
    }
    public function userAnswered()
    {
        return $this->belongsTo(User::class, 'answered_id');
    }
    public function createById(){
        return $this->belongsTo(User::class, 'createBy_id');
    }
    public function reason()
    {
        return $this->belongsTo(Motivo::class, 'reason_id');
    }
    public function origin()
    {
        return $this->belongsTo(Origin::class, 'origin_id');
    }
}

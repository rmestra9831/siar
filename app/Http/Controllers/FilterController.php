<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Radicado;
use App\Http\Controllers\Auth;

class FilterController extends Controller
{
    public function indexFilterState(){
        return view('pages.filters.indexState');
    }
    public function indexFilterGeneral(){
        return view('pages.filters.indexGeneral');
    }
    public function getFilterRadics(){
        if (auth()->user()->hasrole('Admisiones')) {
            return datatables()->eloquent(Radicado::query())
            ->addColumn('consecutive', function($data){ return $data->consecutive; })
            ->addColumn('names', function($data){ return $data->first_name.' '.$data->last_name;})
            ->addColumn('programa', function($data){ return $data->program->name;})
            ->addColumn('origen', function($data){ return $data->origin->origin_name;})
            ->addColumn('destino', function($data){ return $data->destination->name;})
            ->addColumn('caracter', function($data){ return $data->type_reason;})
            ->addColumn('motivo', function($data){ return $data->reason->name;})
            ->addColumn('createBy', function($data){ return $data->createById->name;})
            ->addColumn('delegateTo', function($data){ if(!$data->state->delegated){ return 'N/a';}else{return $data->delegateId->name;}})
            ->addColumn('answerBy', function($data){ if(!$data->state->answered){ return 'N/a';}else{return $data->userAnswered->name;}})
            ->addColumn('sent_dir', function($data){ if(!$data->date_sent_dir){ return 'N/a';}else{return $data->date_sent_dir;}})
            ->addColumn('get_dir', function($data){ if(!$data->date_get_dir){ return 'N/a';}else{return $data->date_get_dir;}})
            ->addColumn('delegado', function($data){ if(!$data->date_delegate){ return 'N/a';}else{return $data->date_delegate;}})
            ->addColumn('answered', function($data){ if(!$data->date_answered){ return 'N/a';}else{return $data->date_answered;}})
            ->addColumn('sentAdmission', function($data){ if(!$data->date_sent_admissions){ return 'N/a';}else{return $data->date_sent_admissions;}})
            ->addColumn('sentMail', function($data){ if(!$data->date_sent_mail){ return 'N/a';}else{return $data->date_sent_mail;}})
            ->addColumn('sentDelivered', function($data){ if(!$data->date_delivered){ return 'N/a';}else{return $data->date_delivered;}})
            ->toJson();
        }
        if (auth()->user()->hasrole('Jef Programa')) {
            return datatables()->eloquent(Radicado::query()->where('delegate_id',auth()->user()->id))
            ->addColumn('consecutive', function($data){ return $data->consecutive; })
            ->addColumn('names', function($data){ return $data->first_name.' '.$data->last_name;})
            ->addColumn('programa', function($data){ return $data->program->name;})
            ->addColumn('origen', function($data){ return $data->origin->origin_name;})
            ->addColumn('destino', function($data){ return $data->destination->name;})
            ->addColumn('caracter', function($data){ return $data->type_reason;})
            ->addColumn('motivo', function($data){ return $data->reason->name;})
            ->addColumn('createBy', function($data){ return $data->createById->name;})
            ->addColumn('delegateTo', function($data){ if(!$data->state->delegated){ return 'N/a';}else{return $data->delegateId->name;}})
            ->addColumn('answerBy', function($data){ if(!$data->state->answered){ return 'N/a';}else{return $data->userAnswered->name;}})
            ->addColumn('sent_dir', function($data){ if(!$data->date_sent_dir){ return 'N/a';}else{return $data->date_sent_dir;}})
            ->addColumn('get_dir', function($data){ if(!$data->date_get_dir){ return 'N/a';}else{return $data->date_get_dir;}})
            ->addColumn('delegado', function($data){ if(!$data->date_delegate){ return 'N/a';}else{return $data->date_delegate;}})
            ->addColumn('answered', function($data){ if(!$data->date_answered){ return 'N/a';}else{return $data->date_answered;}})
            ->addColumn('sentAdmission', function($data){ if(!$data->date_sent_admissions){ return 'N/a';}else{return $data->date_sent_admissions;}})
            ->addColumn('sentMail', function($data){ if(!$data->date_sent_mail){ return 'N/a';}else{return $data->date_sent_mail;}})
            ->addColumn('sentDelivered', function($data){ if(!$data->date_delivered){ return 'N/a';}else{return $data->date_delivered;}})
            ->toJson();
        }
        if (auth()->user()->hasrole('Direccion')) {
            return datatables()->eloquent(Radicado::query()->where('date_sent_dir','!=',null))
            ->addColumn('consecutive', function($data){ return $data->consecutive; })
            ->addColumn('names', function($data){ return $data->first_name.' '.$data->last_name;})
            ->addColumn('programa', function($data){ return $data->program->name;})
            ->addColumn('origen', function($data){ return $data->origin->origin_name;})
            ->addColumn('destino', function($data){ return $data->destination->name;})
            ->addColumn('caracter', function($data){ return $data->type_reason;})
            ->addColumn('motivo', function($data){ return $data->reason->name;})
            ->addColumn('createBy', function($data){ return $data->createById->name;})
            ->addColumn('delegateTo', function($data){ if(!$data->state->delegated){ return 'N/a';}else{return $data->delegateId->name;}})
            ->addColumn('answerBy', function($data){ if(!$data->state->answered){ return 'N/a';}else{return $data->userAnswered->name;}})
            ->addColumn('sent_dir', function($data){ if(!$data->date_sent_dir){ return 'N/a';}else{return $data->date_sent_dir;}})
            ->addColumn('get_dir', function($data){ if(!$data->date_get_dir){ return 'N/a';}else{return $data->date_get_dir;}})
            ->addColumn('delegado', function($data){ if(!$data->date_delegate){ return 'N/a';}else{return $data->date_delegate;}})
            ->addColumn('answered', function($data){ if(!$data->date_answered){ return 'N/a';}else{return $data->date_answered;}})
            ->addColumn('sentAdmission', function($data){ if(!$data->date_sent_admissions){ return 'N/a';}else{return $data->date_sent_admissions;}})
            ->addColumn('sentMail', function($data){ if(!$data->date_sent_mail){ return 'N/a';}else{return $data->date_sent_mail;}})
            ->addColumn('sentDelivered', function($data){ if(!$data->date_delivered){ return 'N/a';}else{return $data->date_delivered;}})
            ->toJson();
        }
        
    }
    public function getFilterState($status){
        if (auth()->user()->hasrole('Admisiones')) {
            $stateFinal;
            /**DILTRADO DE RADICADOS */
            if ($status == 'newsRadic') {$stateFinal = Radicado::query()->join('states','radicados.id','=','states.radic_id')->where([['sede_id', auth()->user()->sede->id],['sent_dir',1]]);};
            if ($status == 'recived_dir') {$stateFinal = Radicado::query()->join('states','radicados.id','=','states.radic_id')->where([['sede_id', auth()->user()->sede->id],['sent_dir',1],['recived_dir',1]]);};
            if ($status == 'answered') {$stateFinal = Radicado::query()->join('states','radicados.id','=','states.radic_id')->where([['sede_id', auth()->user()->sede->id],['answered',1],['aproved',1]]);};
            if ($status == 'pendingAdmission') {$stateFinal = Radicado::query()->join('states','radicados.id','=','states.radic_id')->where([['sede_id', auth()->user()->sede->id],['sent_dir',null]])->orWhere('sentAdmissions',null);};
            if ($status == 'delivered') {$stateFinal = Radicado::query()->join('states','radicados.id','=','states.radic_id')->where([['sede_id', auth()->user()->sede->id],['date_delivered','!=',null]]);};
            if ($status == 'importants') {$stateFinal = Radicado::query()->where('atention','Urgente');};
            //DATATABLE
            return datatables()->eloquent($stateFinal)
            ->addColumn('consecutive', function($data){ return $data->consecutive; })
            ->addColumn('names', function($data){ return $data->first_name.' '.$data->last_name;})
            ->addColumn('programa', function($data){ return $data->program->name;})
            ->addColumn('origen', function($data){ return $data->origin->origin_name;})
            ->addColumn('destino', function($data){ return $data->destination->name;})
            ->addColumn('caracter', function($data){ return $data->type_reason;})
            ->addColumn('motivo', function($data){ return $data->reason->name;})
            ->addColumn('createBy', function($data){ return $data->createById->name;})
            ->addColumn('delegateTo', function($data){ if(!$data->state->delegated){ return 'N/a';}else{return $data->delegateId->name;}})
            ->addColumn('answerBy', function($data){ if(!$data->state->answered){ return 'N/a';}else{return $data->userAnswered->name;}})
            ->addColumn('sent_dir', function($data){ if(!$data->date_sent_dir){ return 'N/a';}else{return $data->date_sent_dir;}})
            ->addColumn('get_dir', function($data){ if(!$data->date_get_dir){ return 'N/a';}else{return $data->date_get_dir;}})
            ->addColumn('delegado', function($data){ if(!$data->date_delegate){ return 'N/a';}else{return $data->date_delegate;}})
            ->addColumn('answered', function($data){ if(!$data->date_answered){ return 'N/a';}else{return $data->date_answered;}})
            ->addColumn('sentAdmission', function($data){ if(!$data->date_sent_admissions){ return 'N/a';}else{return $data->date_sent_admissions;}})
            ->addColumn('sentMail', function($data){ if(!$data->date_sent_mail){ return 'N/a';}else{return $data->date_sent_mail;}})
            ->addColumn('sentDelivered', function($data){ if(!$data->date_delivered){ return 'N/a';}else{return $data->date_delivered;}})
            ->toJson();
        }
        if (auth()->user()->hasrole('Direccion')) {
            $stateFinal;
            //** FILTRADO DE RADICADOS DE ESTADO */
            if ($status == 'newsRadic') {$stateFinal = Radicado::query()->join('states','radicados.id','=','states.radic_id')->where([['sede_id', auth()->user()->sede->id],['sent_dir',1],['recived_dir',null]]);};
            if ($status == 'pendingAnswer') {$stateFinal = Radicado::query()->join('states','radicados.id','=','states.radic_id')->where([['sede_id', auth()->user()->sede->id],['recived_dir',1],['answered',null]]);};
            if ($status == 'answered') {$stateFinal = Radicado::query()->join('states','radicados.id','=','states.radic_id')->where([['sede_id', auth()->user()->sede->id],['recived_dir',1],['answered',1],['answerCheck',null]]);};
            if ($status == 'delegateAnswer') {$stateFinal = Radicado::query()->join('states','radicados.id','=','states.radic_id')->where([['sede_id', auth()->user()->sede->id],['recived_dir',1],['delegated',1]]);};
            if ($status == 'modifyAnswer') {$stateFinal = Radicado::query()->join('states','radicados.id','=','states.radic_id')->where([['sede_id', auth()->user()->sede->id],['answerCheck',1],['answered',1]]);};
            if ($status == 'verifyAnswer') {$stateFinal = Radicado::query()->join('states','radicados.id','=','states.radic_id')->where([['sede_id', auth()->user()->sede->id],['delegated',1],['answered',1],['aproved',null],['answerCheck',null]]);};
            if ($status == 'aproved') {$stateFinal = Radicado::query()->join('states','radicados.id','=','states.radic_id')->where([['sede_id', auth()->user()->sede->id],['delegated',1],['answered',1],['aproved',1]])->orWhere([['answered',1],['aproved',1]]);};
            if ($status == 'importants') {$stateFinal = Radicado::query()->where([['sede_id', auth()->user()->sede->id],['date_sent_dir','!=',null],['atention','Urgente']]);};
            // DATATABLE
            return datatables()->eloquent($stateFinal)
            ->addColumn('consecutive', function($data){ return $data->consecutive; })
            ->addColumn('names', function($data){ return $data->first_name.' '.$data->last_name;})
            ->addColumn('programa', function($data){ return $data->program->name;})
            ->addColumn('origen', function($data){ return $data->origin->origin_name;})
            ->addColumn('destino', function($data){ return $data->destination->name;})
            ->addColumn('caracter', function($data){ return $data->type_reason;})
            ->addColumn('motivo', function($data){ return $data->reason->name;})
            ->addColumn('createBy', function($data){ return $data->createById->name;})
            ->addColumn('delegateTo', function($data){ if(!$data->state->delegated){ return 'N/a';}else{return $data->delegateId->name;}})
            ->addColumn('answerBy', function($data){ if(!$data->state->answered){ return 'N/a';}else{return $data->userAnswered->name;}})
            ->addColumn('sent_dir', function($data){ if(!$data->date_sent_dir){ return 'N/a';}else{return $data->date_sent_dir;}})
            ->addColumn('get_dir', function($data){ if(!$data->date_get_dir){ return 'N/a';}else{return $data->date_get_dir;}})
            ->addColumn('delegado', function($data){ if(!$data->date_delegate){ return 'N/a';}else{return $data->date_delegate;}})
            ->addColumn('answered', function($data){ if(!$data->date_answered){ return 'N/a';}else{return $data->date_answered;}})
            ->addColumn('sentAdmission', function($data){ if(!$data->date_sent_admissions){ return 'N/a';}else{return $data->date_sent_admissions;}})
            ->addColumn('sentMail', function($data){ if(!$data->date_sent_mail){ return 'N/a';}else{return $data->date_sent_mail;}})
            ->addColumn('sentDelivered', function($data){ if(!$data->date_delivered){ return 'N/a';}else{return $data->date_delivered;}})
            ->toJson();
        }
        if (auth()->user()->hasrole('Jef Programa')) {
            $stateFinal;
            //** FILTRADO DE RADICADOS DE ESTADO */
            if ($status == 'newsRadic') {$stateFinal = Radicado::query()->where('delegate_id', auth()->user()->id)->join('states','radicados.id','=','states.radic_id')->where([['sede_id', auth()->user()->sede->id],['delegated',1],['answered',null]]);};
            if ($status == 'pendingAnswer') {$stateFinal = Radicado::query()->join('states','radicados.id','=','states.radic_id')->where([['sede_id', auth()->user()->sede->id],['delegated',1],['answered',null]]);};
            if ($status == 'answered') {$stateFinal = Radicado::query()->join('states','radicados.id','=','states.radic_id')->where([['sede_id', auth()->user()->sede->id],['delegated',1],['answered',1]]);};
            if ($status == 'verifyAnswer') {$stateFinal = Radicado::query()->join('states','radicados.id','=','states.radic_id')->where([['sede_id', auth()->user()->sede->id],['delegated',1],['answered',1],['aproved',null],['answerCheck',1]]);};
            if ($status == 'aproved') {$stateFinal = Radicado::query()->join('states','radicados.id','=','states.radic_id')->where([['sede_id', auth()->user()->sede->id],['delegated',1],['answered',1],['aproved',1]]);};
            if ($status == 'importants') {$stateFinal = Radicado::query()->where([['sede_id', auth()->user()->sede->id],['delegate_id',1],['atention','Urgente']]);};
            // DATATABLE
            return datatables()->eloquent($stateFinal)
            ->addColumn('consecutive', function($data){ return $data->consecutive; })
            ->addColumn('names', function($data){ return $data->first_name.' '.$data->last_name;})
            ->addColumn('programa', function($data){ return $data->program->name;})
            ->addColumn('origen', function($data){ return $data->origin->origin_name;})
            ->addColumn('destino', function($data){ return $data->destination->name;})
            ->addColumn('caracter', function($data){ return $data->type_reason;})
            ->addColumn('motivo', function($data){ return $data->reason->name;})
            ->addColumn('createBy', function($data){ return $data->createById->name;})
            ->addColumn('delegateTo', function($data){ if(!$data->state->delegated){ return 'N/a';}else{return $data->delegateId->name;}})
            ->addColumn('answerBy', function($data){ if(!$data->state->answered){ return 'N/a';}else{return $data->userAnswered->name;}})
            ->addColumn('sent_dir', function($data){ if(!$data->date_sent_dir){ return 'N/a';}else{return $data->date_sent_dir;}})
            ->addColumn('get_dir', function($data){ if(!$data->date_get_dir){ return 'N/a';}else{return $data->date_get_dir;}})
            ->addColumn('delegado', function($data){ if(!$data->date_delegate){ return 'N/a';}else{return $data->date_delegate;}})
            ->addColumn('answered', function($data){ if(!$data->date_answered){ return 'N/a';}else{return $data->date_answered;}})
            ->addColumn('sentAdmission', function($data){ if(!$data->date_sent_admissions){ return 'N/a';}else{return $data->date_sent_admissions;}})
            ->addColumn('sentMail', function($data){ if(!$data->date_sent_mail){ return 'N/a';}else{return $data->date_sent_mail;}})
            ->addColumn('sentDelivered', function($data){ if(!$data->date_delivered){ return 'N/a';}else{return $data->date_delivered;}})
            ->toJson();
        }
    }
}

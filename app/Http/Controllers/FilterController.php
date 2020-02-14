<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Radicado;

class FilterController extends Controller
{
    public function indexFilterState(){
        return view('pages.filters.indexState');
    }
    public function indexFilterGeneral(){
        return view('pages.filters.indexGeneral');
    }
    public function getFilterRadics(){
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
            ->toJson();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UploadWord;
use Illuminate\Http\Request;
use App\Models\Radicado;
use App\Models\Program;
use App\Models\Origin;
use App\Models\Motivo;
use App\Models\State;
use Carbon\Carbon;
use DB;

class AnswerController extends Controller
{
    public function Answertext(Request $request, $slug){
        $radicado = Radicado::where('slug',$slug)->firstOrFail();

        $radicado->answer_text = $request->answer;
        $radicado->date_answered = Carbon::now();
        $radicado->state->update(['answered'=>true]);
        //VALIDANDO QUE SEA EL DIRECTOR QUE GENERE LA RESPUESTA Y AUTOAPROVACIÓN
        if (auth()->user()->hasrole('Direccion')) {
            $radicado->state->update(['aproved'=>true]);
        }
        $radicado->answered_id = auth()->user()->id;
        $radicado->save();
        return redirect()->route('viewRadic',[$slug])->with('statusAnswer','Radicado respondido exitosamente');
    }
    public function fileAnswer(UploadWord $request, $slug){
        $radicado = Radicado::where('slug',$slug)->firstOrFail();
        $dd = $request->file('fileAnswer')->storeAs('answers','respuesta_radicado_'.str_replace(['/','-'],'_',$radicado->consecutive).'.docx');
        $radicado->date_answered = Carbon::now();
        $radicado->answer_file = $dd;
        $radicado->state->update(['answered'=>true]);
        //VALIDANDO QUE SEA EL DIRECTOR QUE GENERE LA RESPUESTA Y AUTOAPROVACIÓN
        if (auth()->user()->hasrole('Direccion')) {
            $radicado->state->update(['aproved'=>true]);
        }
        $radicado->answered_id = auth()->user()->id;
        $radicado->save();        
        return redirect()->route('viewRadic',[$slug])->with('statusAnswer','Radicado subido exitosamente');
    }
    public function delegateAnswer(Request $request, $slug){
        $radicado = Radicado::where('slug',$slug)->firstOrFail();
        $radicado->delegate_id = $request->selectMulipleAnswer;
        $radicado->state->update(['delegated'=>true]);
        $radicado->save();
        return redirect()->route('viewRadic',[$slug])->with('status','Radicado delegado exitosamente');
    }
}

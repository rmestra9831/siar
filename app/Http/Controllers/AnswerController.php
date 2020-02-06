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
        $radicado->state->update(['delegated'=>true ,'answered'=>true]);
        $radicado->save();
        return redirect()->route('viewRadic',[$slug])->with('status','Radicado respondido exitosamente');
    }
    public function fileAnswer(UploadWord $request, $slug){
        // return redirect()->route('viewRadic',[$slug])->with('status','Radicado respondido exitosamente');
        return redirect()->route('viewRadic',[$slug])->with('status','Radicado subido exitosamente');
    }
    public function delegateAnswer(Request $request, $slug){
        // return redirect()->route('viewRadic',[$slug])->with('status','Radicado respondido exitosamente');
        return $request;
    }
}

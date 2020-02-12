<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Notifications\RedirectionPetition;
use App\Notifications\RedirectionRespon;
use App\Notifications\RadicadoAnswered;
use App\Notifications\DelegateUser;
use App\Http\Requests\UploadWord;
use Illuminate\Http\Request;
use App\Models\Radicado;
use App\Models\Program;
use App\Models\Origin;
use App\Models\Motivo;
use App\Models\State;
use App\User;
use Carbon\Carbon;
use DB;

class AnswerController extends Controller
{
    public function Answertext(Request $request, $slug){
        $radicado = Radicado::where('slug',$slug)->firstOrFail();
        //ORGANIZANDO CONSECUTIVO DE RESPUESTA
        if ($radicado->origin->origin_name == 'GEN') {$number = str_pad(auth()->user()->origin_gen +1 , 5, "0", STR_PAD_LEFT); DB::table('users')->where('id', auth()->user()->id)->increment('origin_gen',1);};//agregando ceros al numero traido de la db
        if ($radicado->origin->origin_name == 'EST') {$number = str_pad(auth()->user()->origin_est +1 , 5, "0", STR_PAD_LEFT); DB::table('users')->where('id', auth()->user()->id)->increment('origin_est',1);};//agregando ceros al numero traido de la db
        if ($radicado->origin->origin_name == 'DOC') {$number = str_pad(auth()->user()->origin_doc +1 , 5, "0", STR_PAD_LEFT); DB::table('users')->where('id', auth()->user()->id)->increment('origin_doc',1);};//agregando ceros al numero traido de la db  
        $name_sede = substr($radicado->sede->name, 0, 3); //obteniendo la sede donde se crea el radicado
        if($name_sede == 'bar'){$name_sede = 'BCA';}; if($name_sede == 'bar'){$name_sede = 'BCA';}; //formateando a BCA
        $consecutiveAnswer = auth()->user()->ident.'-'.$radicado->origin->origin_name.'-'.$name_sede.'-'.$number.'-'.Carbon::now()->isoFormat('Y');
        $radicado->answer_file = null;
        $radicado->answer_text = $request->answer;
        $radicado->date_answered = Carbon::now();
        $radicado->consecutiveAnswer = $consecutiveAnswer;
        $radicado->state->update(['answered'=>true]);
        if($radicado->state->answerCheck == 1){$radicado->state->update(['answerCheck'=> null]);};
        //VALIDANDO QUE SEA EL DIRECTOR QUE GENERE LA RESPUESTA Y AUTOAPROVACIÓN
        if (auth()->user()->hasrole('Direccion')) {$radicado->state->update(['aproved'=>true]);}
        $radicado->answered_id = auth()->user()->id;
        $radicado->save();
        //ENVIO DE CORREO
        if ($radicado->state->delegated) {
            $user = User::find(2);
            $url = $_SERVER['HTTP_HOST'];
            $user->notify(new RadicadoAnswered($radicado, $url));
        }
        return redirect()->route('viewRadic',[$slug])->with('statusAnswer','Radicado respondido exitosamente');
    }
    public function fileAnswer(UploadWord $request, $slug){
        $radicado = Radicado::where('slug',$slug)->firstOrFail();
        //ORGANIZANDO CONSECUTIVO DE RESPUESTA
        if ($radicado->origin->origin_name == 'GEN') {$number = str_pad(auth()->user()->origin_gen +1 , 5, "0", STR_PAD_LEFT); DB::table('users')->where('id', auth()->user()->id)->increment('origin_gen',1);};//agregando ceros al numero traido de la db
        if ($radicado->origin->origin_name == 'EST') {$number = str_pad(auth()->user()->origin_est +1 , 5, "0", STR_PAD_LEFT); DB::table('users')->where('id', auth()->user()->id)->increment('origin_est',1);};//agregando ceros al numero traido de la db
        if ($radicado->origin->origin_name == 'DOC') {$number = str_pad(auth()->user()->origin_doc +1 , 5, "0", STR_PAD_LEFT); DB::table('users')->where('id', auth()->user()->id)->increment('origin_doc',1);};//agregando ceros al numero traido de la db  
        $name_sede = substr($radicado->sede->name, 0, 3); //obteniendo la sede donde se crea el radicado
        if($name_sede == 'bar'){$name_sede = 'BCA';}; if($name_sede == 'bar'){$name_sede = 'BCA';}; //formateando a BCA
        $consecutiveAnswer = auth()->user()->ident.'-'.$radicado->origin->origin_name.'-'.$name_sede.'-'.$number.'-'.Carbon::now()->isoFormat('Y');
        $dd = $request->file('fileAnswer')->storeAs('public/answers','respuesta_radicado_'.$consecutiveAnswer.'.docx');
        
        $radicado->date_answered = Carbon::now();
        $radicado->answer_file = $dd;
        $radicado->answer_text = null;
        $radicado->state->update(['answered'=>true]);
        $radicado->consecutiveAnswer = $consecutiveAnswer;
        if($radicado->state->answerCheck == 1){$radicado->state->update(['answerCheck'=> null]);};
        // VALIDANDO QUE SEA EL DIRECTOR QUE GENERE LA RESPUESTA Y AUTOAPROVACIÓN
        if (auth()->user()->hasrole('Direccion')) {
            $radicado->state->update(['aproved'=>true]);
        }
        $radicado->answered_id = auth()->user()->id;
        $radicado->save();  
        //ENVIO DE CORREO DE RESPUESTA 
        if ($radicado->state->delegated) {
            $user = User::find(2);
            $url = $_SERVER['HTTP_HOST'];
            $user->notify(new RadicadoAnswered($radicado, $url));
        }
        return redirect()->route('viewRadic',[$slug])->with('statusAnswer','Radicado subido exitosamente');
    }
    public function delegateAnswer(Request $request, $slug){
        $radicado = Radicado::where('slug',$slug)->firstOrFail();
        $radicado->delegate_id = $request->selectMulipleAnswer;
        $radicado->date_delegate = Carbon::now();
        $radicado->state->update(['delegated'=>true]);
        $radicado->save();
        //ENVIO DE CORREO
        $user = User::find($request->selectMulipleAnswer);
        $url = $_SERVER['HTTP_HOST'];
        $user->notify(new DelegateUser($radicado, $url));
        return redirect()->route('viewRadic',[$slug])->with('status','Radicado delegado exitosamente');
    }
    public function redirectionAnswerPetition(Request $request, $slug){
        $radicado = Radicado::where('slug',$slug)->firstOrFail();
        $radicado->date_petition_redirection = Carbon::now();
        $radicado->state->update(['redirection'=>true]);
        $radicado->redirect_txt = $request->redirectAnswer;
        $radicado->save();
        //ENVIO DE CORREO
        $user = User::find(2);
        $url = $_SERVER['HTTP_HOST'];
        $user->notify(new RedirectionPetition($radicado, $url));

        return redirect()->route('viewRadic',[$slug])->with('status','Petición Denegada');
    }
    public function refuseRedirection($slug){
        $radicado = Radicado::where('slug',$slug)->firstOrFail();
        $radicado->state->update(['redirection'=>false]);
        $radicado->save();
        //ENVIO DE CORREO
        $user = User::find($radicado->delegate_id);
        $url = $_SERVER['HTTP_HOST'];
        $user->notify(new RedirectionRespon($radicado, $url));

        return redirect()->route('viewRadic',[$slug])->with('status','Petición respondida');
    }
    public function acceptRedirection($slug){
        $radicado = Radicado::where('slug',$slug)->firstOrFail();
        $radicado->state->update(['redirection'=>false]);
        $radicado->state->update(['delegated'=>false]);
        $radicado->date_update_redirection = Carbon::now();
        //ENVIO DE CORREO
        $user = User::find($radicado->delegate_id);
        $url = $_SERVER['HTTP_HOST'];
        $user->notify(new RedirectionRespon($radicado, $url));
        //SI HAY RESPUESTAS PASADAS O ALGO SE BORRA TODO
        $radicado->delegate_id = null; 
        $radicado->answered_id = null;
        $radicado->answer_file = null;
        $radicado->answer_text = null;
        $radicado->date_delegate = null;
        $radicado->date_answered = null;
        $radicado->state->update(['answerCheck'=> 0]);
        $radicado->state->update(['answered'=> 0]);
        $radicado->save();
        return redirect()->route('viewRadic',[$slug])->with('status','Petición Aceptada');
    }
    public function EditAnswer($slug){
        $radicado = Radicado::where('slug',$slug)->firstOrFail();
        //ORGANIZANDO CONSECUTIVO DE RESPUESTA
        if ($radicado->origin->origin_name == 'GEN') {$radicado->delegateID->decrement('origin_gen');};//agregando ceros al numero traido de la db
        if ($radicado->origin->origin_name == 'EST') {$radicado->delegateID->decrement('origin_est');};//agregando ceros al numero traido de la db
        if ($radicado->origin->origin_name == 'DOC') {$radicado->delegateID->decrement('origin_doc');};//agregando ceros al numero traido de la db  
        $radicado->consecutiveAnswer = null;
        $radicado->state->update(['answerCheck'=> 1]);
        // dd($radicado->state->answerCheck);
        $radicado->save();
        //ENVIO DE CORREO
        $user = User::find($radicado->delegateId->id);
        $url = $_SERVER['HTTP_HOST'];
        $user->notify(new RadicadoAnswered($radicado, $url));
        return redirect()->route('viewRadic',[$slug])->with('status','Petición de edición enviada');
    }
    public function aproveAnswer($slug){
        $radicado = Radicado::where('slug',$slug)->firstOrFail();
        $radicado->state->update(['aproved'=>true]);
        $radicado->save();
        return redirect()->route('viewRadic',[$slug])->with('status','Respuesta aprobada');
    }
}

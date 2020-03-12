<?php

namespace App\Http\Controllers;

use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Storage;
use App\Notifications\RadicadoAnswered;
use App\Http\Requests\UploadPDF;
use App\Notifications\SentDir;
use Illuminate\Http\Request;
use App\Mail\SentMailOrigin;
use App\Models\Radicado;
use App\Models\Program;
use App\Models\Origin;
use App\Models\Motivo;
use App\Models\State;
use Carbon\Carbon;
use App\User;
use Mail;
use DB;

class RadicadoController extends Controller
{ 
    public function __constructor(){
    
    }
    public function index(){
        $number = str_pad(auth()->user()->sede->cont_radic + 1, 5, "0", STR_PAD_LEFT); //agregando ceros al numero traido de la db
        $name_sede = substr(auth()->user()->sede->name, 0, 3); //obteniendo la sede donde se crea el radicado
        $year = Carbon::now()->isoFormat('D/M/Y'); //obteniendo año
        if($name_sede == 'bar'){$name_sede = 'BCA';}; if($name_sede == 'bar'){$name_sede = 'BCA';}; //formateando a BCA
        return view('pages.createRadicado.viewForm',compact('number','name_sede','year'));
    }
    public function getDataSelects(){
        $select_program = Program::all();
        $select_destino = Program::where('name','Direccion')->get();
        $select_motivo = Motivo::all();
        $select_origen = Origin::get();

        $data = array(
            "select_program"=>$select_program,
            "select_destino"=> $select_destino,
            "select_motivo"=> $select_motivo,
            "select_origen"=> $select_origen,
        );
        return response()->json($data);
    }
    public function store(Request $request){
        if($request->ajax()){
            $number = str_pad(auth()->user()->sede->cont_radic + 1, 5, "0", STR_PAD_LEFT); //agregando ceros al numero traido de la db
            $name_sede = substr(auth()->user()->sede->name, 0, 3); //obteniendo la sede donde se crea el radicado
            $year = Carbon::now()->isoFormat('D/M/Y'); //obteniendo año
            if($name_sede == 'bar'){$name_sede = 'BCA';}; if($name_sede == 'bar'){$name_sede = 'BCA';}; //formateando a BCA

            $radicado =new Radicado();

            if($request->type_reason_radic == 1){$type_reason = 'Administrativo';}else{ $type_reason = 'Academico';} //formatenado tipo de motivo ADM - ACAD

            $radicado->consecutive = ''.$number.'-'.$name_sede.'-'.$year.'';
            $radicado->atention = $request->atention_radic;
            $radicado->origin_id = $request->origin_radic;
            $radicado->destination_id = $request->destination_radic;
            $radicado->sede_id = auth()->user()->sede['id'];
            $radicado->program_id = $request->program_radic;
            $radicado->first_name = $request->firstName;
            $radicado->last_name = $request->lastName;
            $radicado->origin_correo = $request->email;
            $radicado->origin_cel = $request->celphone;
            $radicado->type_reason = $type_reason;
            $radicado->reason_id = $request->reason_radic;
            $radicado->affair = $request->affair;
            $radicado->notes = $request->note;
            $radicado->createBy_id = auth()->user()->id;
            
            //remplazando para el slug
            $format_slug = array('/',' \ ', '-',' ');
            $slug = substr($request->firstName, 0, 4).'-'.$request->consecutive.'-'.substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 4); ;
            $final_slug = str_replace($format_slug,'_',$slug);
            // $radicado->slug = $request->first_name
            
            $radicado->slug = $final_slug;
            $radicado->date_creation = Carbon::now();
        
            $radicado->save();

            //actualizando
            //Estados
            $state = State::create([
                'radic_id' => $radicado->id,
                'start' => true
            ]);
            DB::table('radicados')->where('id', $radicado->id)->update(['states_id'=> $state->id]);
            DB::table('sedes')->where('id', auth()->user()->sede['id'])->increment('cont_radic',1);

            return response()->json($radicado);
        }
    }
    public function getReasons($id){
        $reasons = Motivo::where('type_motivo',$id)->orWhere('type_motivo',3)->get();
        return response()->json($reasons);
    }
    public function getRadicados(){
        $data = Radicado::get();
        return $data->toJson();
    }
    public function viewRadic($slug){
        $radicado = Radicado::where('slug', $slug)->firstOrFail();
        return view('pages.createRadicado.viewRadic', compact('radicado'));
    }
    public function uploadFile(UploadPDF $request, $slug){
        $radic = Radicado::where('slug',$slug)->firstOrFail();
        // dd($request->file('uploadRadic')->storeAs('public/radics','radicado_'.str_replace(['/','-'],'_',$radic->consecutive).'.pdf'));
        $dd = $request->file('uploadRadic')->storeAs('public/radics','radicado_'.str_replace(['/','-'],'_',$radic->consecutive).'.pdf');
        $radic->file = $dd;
        $radic->save();
        return redirect()->route('viewRadic',[$slug])->with('status','Radicado subido exitosamente');
    }
    public function sentDir($slug){
        $radicado = Radicado::where('slug',$slug)->firstOrFail();
        $radicado->date_sent_dir = Carbon::now();
        $radicado->state->update(['sent_dir'=> true]);
        $radicado->save();

        $user = User::find(2);
        $url = $_SERVER['HTTP_HOST'];
        $user->notify(new sentDir($radicado, $url));

        return redirect()->route('viewRadic',[$slug])->with('status','Radicado '.$radicado->consecutive.' enviado a dirección');
    }
    public function getDir($slug){
        $radicado = Radicado::where('slug',$slug)->firstOrFail();
        $radicado->date_get_dir = Carbon::now();
        $radicado->state->update(['recived_dir'=> true]);
        $radicado->save();
        return redirect()->route('viewRadic',[$slug])->with('status','Radicado  exitosamente');
    }
    public function downloadRadic($slug){
        $data = Radicado::where('slug',$slug)->firstOrFail();
        return Storage::download($data->file);
    }
    public function downloadAnswer($slug){
        $data = Radicado::where('slug',$slug)->firstOrFail();
        return Storage::download($data->answer_file);
    }
    public function downloadTemplateWord($slug){
        $radicado = Radicado::where('slug',$slug)->firstOrFail();
        $templateWord = new TemplateProcessor('../public/storage/templates/templateAnswer.docx');
        // PLANTEANDO CONSECUTIVO RESPUESTA RADICADO
        if ($radicado->origin->origin_name == 'GEN') {$number = str_pad(auth()->user()->origin_gen +1 , 5, "0", STR_PAD_LEFT); DB::table('users')->where('id', auth()->user()->id);};//agregando ceros al numero traido de la db
        if ($radicado->origin->origin_name == 'EST') {$number = str_pad(auth()->user()->origin_est +1 , 5, "0", STR_PAD_LEFT); DB::table('users')->where('id', auth()->user()->id);};//agregando ceros al numero traido de la db
        if ($radicado->origin->origin_name == 'DOC') {$number = str_pad(auth()->user()->origin_doc +1 , 5, "0", STR_PAD_LEFT); DB::table('users')->where('id', auth()->user()->id);};//agregando ceros al numero traido de la db  
        $name_sede = substr($radicado->sede->name, 0, 3); //obteniendo la sede donde se crea el radicado
        if($name_sede == 'bar'){$name_sede = 'BCA';}; if($name_sede == 'bar'){$name_sede = 'BCA';}; //formateando a BCA
        $consecutiveAnswer = auth()->user()->ident.'-'.$radicado->origin->origin_name.'-'.$name_sede.'-'.$number.'-'.Carbon::now()->isoFormat('Y');


        $firstName = $radicado->first_name;
        $lastName = $radicado->last_name;
        if($radicado->delegate_id == null){$delegateId = auth()->user()->name;}else{$delegateId = $radicado->delegateId->name;};
        $day = Carbon::now()->isoFormat('DD');
        $monthNumber = Carbon::now()->isoFormat('MM');
        $month = Carbon::now()->isoFormat('MMMM');
        $year = Carbon::now()->isoFormat('YYYY');
        if ($radicado->reason->name == 'Otro') { $reason = $radicado->affair; }else{$reason = $radicado->reason->name;};
        if ($radicado->delegate_id == null) { $program = 'Dirección';}else{$program = 'Programa de '.$radicado->delegateId->program->name;}
        if($radicado->delegate_id == null){$correo = auth()->user()->email;}else{$correo = $radicado->delegateId->email;};
        $city = $radicado->sede->name;

        $templateWord->setValue('consecutivo_respuesta',$consecutiveAnswer);
        $templateWord->setValue('primer_nombre',ucwords($firstName));
        $templateWord->setValue('segundo_nombre',ucwords($lastName));
        $templateWord->setValue('responsable_respuesta',ucwords($delegateId));
        $templateWord->setValue('responsable_respuesta_footer',strtoupper($delegateId));
        $templateWord->setValue('correo',strtolower($correo));
        $templateWord->setValue('program',ucwords($program));
        $templateWord->setValue('monthNumber',$monthNumber);
        $templateWord->setValue('city',ucwords($city));
        $templateWord->setValue('month',ucwords($month));
        $templateWord->setValue('day',$day);
        $templateWord->setValue('year',$year);
        $templateWord->setValue('razon',$reason);

        $templateWord->saveAs('storage/templates/Plantilla_respuesta.docx');
        return Storage::download('public/templates/Plantilla_respuesta.docx');
    }
    public function sentAdmissions($slug){
        $radicado = Radicado::where('slug',$slug)->firstOrFail();
        $radicado->state->update(['sentAdmissions'=>true]);
        $radicado->date_sent_admissions = Carbon::now();
        $radicado->save();
        //ENVIO DE CORREO
        $user = User::find($radicado->createById->id);
        $url = $_SERVER['HTTP_HOST'];
        $user->notify(new RadicadoAnswered($radicado, $url));
        return redirect()->route('viewRadic',[$slug])->with('status','Radicado  enviado a admisiones exitosamente');
    }
    public function readNotify(Request $request, $user){
        if ($request->ajax()) {
            $userNotify = User::find($user);
            $idNotification = $request->idNotify;
            if ($userNotify->hasrole('Direccion')) {
                $radicado = Radicado::where('slug',$request->slug)->firstOrFail();
                $radicado->date_get_dir = Carbon::now();
                $radicado->state->update(['recived_dir'=> true]);
                $radicado->save();
                foreach ($userNotify->unreadNotifications as $notification) {
                    if ($notification->id == $idNotification) {
                         $notification->markAsRead();
                        return response()->json(true);
                    }
                 }
            }else{
                foreach ($userNotify->unreadNotifications as $notification) {
                   if ($notification->id == $idNotification) {
                        $notification->markAsRead();
                       return response()->json(true);
                   }
                }
            }
        }
    }
    public function readAllNotify(Request $request, $user){
        if ($request->ajax()) {
            $userNotify = User::find($user);
            $userNotify->unreadNotifications->markAsRead();
            // dd($userNorify->unreadNotifications);
            return response()->json(true);
        }
    }
    public function sentMailDeliveredView($slug){
        $radicado = Radicado::where('slug', $slug)->firstOrFail();
        return view('pages.sentMailDelivering', compact('radicado'));
    }
    public function sentMailDelivered($id){
        $radicado = Radicado::firstWhere('id',$id);
        $radicado->date_sent_mail = Carbon::now();
        $radicado->save();
        Mail::to($radicado->origin_correo)->send(new SentMailOrigin($radicado));
        return response()->json(true);
    }
    public function DeliveredRadic($slug){
        $radicado = Radicado::firstWhere('slug', $slug);
        $radicado->date_delivered = Carbon::now();
        $radicado->save();
        return $radicado;
    }
}

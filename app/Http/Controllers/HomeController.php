<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Radicado;
use Illuminate\Support\Arr;
use App\User;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        // $radicados =  Cache::rememberForever('radicados', function () {
        
        // });
        $radicados = Radicado::where('sede_id',auth()->user()->sede_id)->paginate(2);
        return view('home', ['radicados'=> $radicados]);
    }

    public function example(){
        $data = Radicado::where('sede_id',auth()->user()->sede_id)->get();

        // return response()->json($data);
      return view('welcome', compact('data'));
    }
}

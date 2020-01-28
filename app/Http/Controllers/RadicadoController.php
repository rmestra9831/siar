<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RadicadoController extends Controller
{
    public function index(){
        return view('pages.createRadicado.viewForm');
    }
}

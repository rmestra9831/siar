<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FunctionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function createProgram(){
        return view('pages.Programs');
    }
}

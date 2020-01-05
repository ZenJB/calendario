<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Aulas extends Controller
{
    //
    function index(){
        return view('aulas');
    }
}

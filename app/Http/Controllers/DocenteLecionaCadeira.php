<?php

namespace App\Http\Controllers;

use App\User;
use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use DB;

class DocenteLecionaCadeira extends Controller
{
    //
    function index(){
        $cadeiras = DB::table('cadeira')->select('id', 'nome')->get();
        $cursos = DB::table('curso')->select('id', 'curso')->get();

        return View::make('docentelecionacadeira', compact('cadeiras','cursos'));
    }
}

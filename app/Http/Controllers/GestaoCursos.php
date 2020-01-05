<?php

namespace App\Http\Controllers;

use App\User;
use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use DB;

class GestaoCursos extends Controller
{
    function index(){
        $cursos = DB::table('curso')->select('id', 'curso')->get();

        return View::make('gestaoCursos', compact('cursos'));
    }

    function add_curso(){
        $id_curso = Input::get('name');

        DB::table('curso')
            ->insert([
                'curso' => $id_curso
            ]);

        $cursos = DB::table('curso')->select('id', 'curso')->get();
        return redirect()->route('gestaoCursos', compact( 'cursos'));
    }

    function change_curso(){
        $id = Input::get('curso');
        $name = Input::get('name');

        DB::table('curso')
            ->where([
                'id' => $id
            ])
            ->update([
                'curso' => $name
            ]);

        $cursos = DB::table('curso')->select('id', 'curso')->get();
        return redirect()->route('gestaoCursos', compact( 'cursos'));
    }

    function remove_curso(){
        $id_curso = Input::get('id');
        DB::table('curso')
            ->where('id', $id_curso)
            ->delete();

        DB::table('cadeira_curso')
            ->where('curso_id', $id_curso)
            ->delete();

        $cursos = DB::table('curso')->select('id', 'curso')->get();
        return redirect()->route('gestaoCursos', compact( 'cursos'));
    }

}

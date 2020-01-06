<?php

namespace App\Http\Controllers;

use App\User;
use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use DB;

class GestaoCadeiras extends Controller
{
//
    function index(){
        $cadeiras = DB::table('cadeira')->select('id', 'nome')->get();
        $cursos = DB::table('curso')->select('id', 'curso')->get();
        $docentes = DB::table('docentes')->select('id')->get();

        return View::make('gestaoCadeiras', compact('cadeiras','cursos', 'docentes'));
    }

    function add_cadeira(){
        $id_curso = Input::get('curso');
        $nome_cadeira = Input::get('name');
        $docente = Input::get('docente');
        $id_cadeira = DB::table('cadeira')
            ->insertGetId(['nome' => $nome_cadeira]);

        DB::table('cadeira_curso')
            ->insert([
                'cadeira_id' => $id_cadeira,
                'curso_id' => $id_curso
            ]);

        DB::table('cadeira_docente')
            ->insert([
                'cadeira_id' => $id_cadeira,
                'docente_id' => $docente
            ]);

        $cadeiras = DB::table('cadeira')->select('id', 'nome')->get();
        $cursos = DB::table('curso')->select('id', 'curso')->get();
        $docentes = DB::table('docentes')->select('id')->get();
        return redirect()->route('gestaoCadeiras', compact('cadeiras','cursos', 'docentes'));
    }

    function remove_cadeira(){
        $id_cadeira = Input::get('id');
        DB::table('cadeira')
            ->where('id', $id_cadeira)
            ->delete();

        $cadeiras = DB::table('cadeira')->select('id', 'nome')->get();
        $cursos = DB::table('curso')->select('id', 'curso')->get();
        $docentes = DB::table('docentes')->select('id')->get();
        return redirect()->route('gestaoCadeiras', compact('cadeiras','cursos', 'docentes'));
    }

    function update_cadeira(){
        $id_curso = Input::get('curso');
        $id_cadeira = Input::get('cadeira');
        $id_docente = Input::get('docente');

        DB::table('cadeira_curso')
            ->where([
                'cadeira_id' => $id_cadeira
            ])
            ->update([
                'curso_id' => $id_curso
            ]);

        try {

            DB::table('cadeira_docente')
                ->where([
                    'cadeira_id' => $id_cadeira
                ])
                ->delete();

        } catch (\Exception $e) {
        }

        DB::table('cadeira_docente')
            ->insert([
                'cadeira_id' => $id_cadeira,
                'docente_id' => $id_docente
            ]);

        $cadeiras = DB::table('cadeira')->select('id', 'nome')->get();
        $cursos = DB::table('curso')->select('id', 'curso')->get();
        $docentes = DB::table('docentes')->select('id')->get();
        return redirect()->route('gestaoCadeiras', compact('cadeiras','cursos', 'docentes'));
    }
}

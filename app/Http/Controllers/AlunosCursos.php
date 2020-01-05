<?php

namespace App\Http\Controllers;


use App\User;
use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use DB;

class AlunosCursos extends Controller
{
    //
    function index(){

        $cursos = DB::table('aluno_curso')->where('aluno_id', Auth::user()->id )->get();
        $lista_cursos = DB::table('curso')->select('id', 'curso')->get();
        return View::make('alunos/cursos', compact('cursos', 'lista_cursos'));
    }

    function deleteCurso(){
        $aluno = Input::get('aluno');
        $curso = Input::get('curso');
        DB::table('aluno_curso')
            ->where([
                'aluno_id' => $aluno,
                'curso_id' => $curso
            ])
            ->delete();

        $cursos = DB::table('aluno_curso')->where('aluno_id', Auth::user()->id )->get();


        $cursos = DB::table('aluno_curso')->where('aluno_id', Auth::user()->id )->get();
        $lista_cursos = DB::table('curso')->select('id', 'curso')->get();
        return redirect()->route('alunos/cursos', compact('cursos', 'lista_cursos'));
    }

    function addCurso(){
        $aluno = Input::get('aluno');
        $curso = Input::get('curso');

        DB::table('aluno_curso')
            ->insert(
                [
                    'aluno_id' => $aluno,
                    'curso_id' => $curso
                ]);


        $cursos = DB::table('aluno_curso')->where('aluno_id', Auth::user()->id )->get();
        $lista_cursos = DB::table('curso')->select('id', 'curso')->get();
        return redirect()->route('alunos/cursos', compact('cursos', 'lista_cursos'));
    }
}

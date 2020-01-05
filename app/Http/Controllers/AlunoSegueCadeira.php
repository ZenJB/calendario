<?php

namespace App\Http\Controllers;

use App\User;
use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use DB;

class AlunoSegueCadeira extends Controller
{
    //
    function index(){

        $cadeiras = DB::table('aluno_has_cadeira')->where('aluno_id', Auth::user()->id )->get();
        $lista_cadeiras = DB::table('cadeira')->select('id', 'nome')->get();
        return View::make('alunos/alunoSegueAula', compact('cadeiras', 'lista_cadeiras'));
    }

    function deleteCadeira(){
        $aluno = Input::get('aluno');
        $cadeira = Input::get('cadeira');
        DB::table('aluno_has_cadeira')
            ->where([
                'aluno_id' => $aluno,
                'cadeira_id' => $cadeira
            ])
            ->delete();

        $cadeiras = DB::table('aluno_has_cadeira')->where('aluno_id', Auth::user()->id )->get();
        $lista_cadeiras = DB::table('cadeira')->select('id', 'nome')->get();
        return redirect()->route('alunoSegueCadeira', compact('cadeiras', 'lista_cadeiras'));
    }

    function addCadeira(){
        $aluno = Input::get('aluno');
        $cadeira = Input::get('cadeira');

        DB::table('aluno_has_cadeira')
            ->insert(
                [
                    'aluno_id' => $aluno,
                    'cadeira_id' => $cadeira
                ]);


        $cadeiras = DB::table('aluno_has_cadeira')->where('aluno_id', Auth::user()->id )->get();
        $lista_cadeiras = DB::table('cadeira')->select('id', 'nome')->get();
        return redirect()->route('alunoSegueCadeira', compact('cadeiras', 'lista_cadeiras'));
    }
}

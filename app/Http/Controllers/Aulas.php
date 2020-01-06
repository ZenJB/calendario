<?php

namespace App\Http\Controllers;

use App\User;
use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use DB;

class Aulas extends Controller
{
    //
    function index(){
        $cadeiras = DB::table('cadeira')->select('id', 'nome')->get();

        return View::make('aulas', compact('cadeiras'));
    }

    function add_aula(){
        $titulo = Input::get('titulo');
        $cadeira = Input::get('cadeira');
        $descricao = Input::get('descricao');
        $data_inicio = Input::get('data_inicio');
        $data_fim = Input::get('data_fim');

        DB::table('cadeira_eventos')
            ->insert([
                'nome' => $titulo,
                'cadeira_id' => $cadeira,
                'descricao' => $descricao,
                'data_inicio' => $data_inicio,
                'data_fim' => $data_fim,
                'tipo_de_evento' => 'aula',
                'aceite' => '0'
            ]);

        $cadeiras = DB::table('cadeira')->select('id', 'nome')->get();
        return redirect()->route('aulas', compact('cadeiras'));
    }

    function delete_aula(){
        $cadeira_id = Input::get('id');
        DB::table('cadeira_eventos')
            ->where([
                'id' => $cadeira_id
            ])
            ->delete();

        $cadeiras = DB::table('cadeira')->select('id', 'nome')->get();
        return redirect()->route('aulas', compact('cadeiras'));
    }
}

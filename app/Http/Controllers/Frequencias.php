<?php

namespace App\Http\Controllers;

use App\User;
use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use DB;

class Frequencias extends Controller
{
    //
    function index(){
        $cadeiras = DB::table('cadeira')->select('id', 'nome')->get();

        return View::make('frequencias', compact('cadeiras'));
    }

    function add_frequencia(){
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
                'tipo_de_evento' => 'frequencia',
                'aceite' => '0'
            ]);

        $cadeiras = DB::table('cadeira')->select('id', 'nome')->get();
        return redirect()->route('frequencias', compact('cadeiras'));
    }

    function delete_frequencia(){
        $cadeira_id = Input::get('id');
        DB::table('cadeira_eventos')
            ->where([
                'id' => $cadeira_id
            ])
            ->delete();

        $cadeiras = DB::table('cadeira')->select('id', 'nome')->get();
        return redirect()->route('frequencias', compact('cadeiras'));
    }
}

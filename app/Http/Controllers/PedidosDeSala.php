<?php

namespace App\Http\Controllers;

use App\User;
use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use DB;

class PedidosDeSala extends Controller
{
    //
    function index(){
        $cadeiras = DB::table('cadeira')->select('id', 'nome')->get();

        return View::make('pedidosdesala', compact('cadeiras'));
    }

    function api_aceitar_rejeitar_sala(){
        $pedido_id = Input::get('id');
        $acao = Input::get('submit');
        if(strcmp($acao,'Aceitar') == 0)
        {
            DB::table('cadeira_eventos')
                ->where([
                    'id' => $pedido_id
                ])
                ->update([
                    'aceite' => '1'
                ]);
        }else{
            DB::table('cadeira_eventos')
                ->where([
                    'id' => $pedido_id
                ])
                ->update([
                    'aceite' => '2'
                ]);
        }


        $cadeiras = DB::table('cadeira')->select('id', 'nome')->get();
        return redirect()->route('pedidosdesala', compact( 'cadeiras'));
    }
}

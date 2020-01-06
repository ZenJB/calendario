<?php

namespace App\Http\Controllers;

use App\User;
use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cadeiras = DB::table('cadeira_eventos')
            ->join('aluno_has_cadeira', 'cadeira_eventos.cadeira_id', '=', 'aluno_has_cadeira.cadeira_id')
            ->where('aluno_id', Auth::user()->id)
            ->get(array(
                'nome',
                'descricao',
                'data_inicio',
                'data_fim',
                'tipo_de_evento'
            ));
        return View::make('home', compact('cadeiras'));
    }
}

<?php

namespace App\Http\Controllers;

use App\User;
use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use DB;

class GerirUtilizadores extends Controller
{
    //
    function index(){
        $users = User::all();
        return View::make('gerirutilizadores', compact('users'));
    }

    function addUser(){
        $name = Input::get('name');
        $email = Input::get('email');
        $password = Input::get('password');
        $user_permissions = Input::get('permissions');
        $user_id = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ])->id;

        if(isset($user_permissions))
            foreach ($user_permissions as $permission)
            {
                switch($permission){
                    case 'aluno':
                        DB::table('alunos')
                            ->insert(['id' => $user_id]);
                        break;
                    case 'admin':
                        DB::table('administradores')
                            ->insert(['id' => $user_id]);
                        break;
                    case 'docente':
                        DB::table('docentes')
                            ->insert(['id' => $user_id]);
                        break;
                    default:
                        break;
                }
            }

        $users = User::all();
        return redirect()->route('gerirutilizadores', compact('users'));
    }


}

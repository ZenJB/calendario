<?php

namespace App\Http\Controllers;

use App\User;
use View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use DB;

class EditarUtilizador extends Controller
{
    //
    function editUser(){

        $user_id = Input::get('id');
        $user_name = Input::get('name');
        $user_email = Input::get('email');
        $identificacao_uma = Input::get('identificacao_uma');

        $user_permissions = Input::get('permissions');

        $submitBTN = Input::get('submit');
        if(strcmp($submitBTN, 'Remover') == 0)
        {
            DB::table('alunos')
                ->where('id', $user_id)
                ->delete();
            DB::table('docentes')
                ->where('id', $user_id)
                ->delete();
            DB::table('administradores')
                ->where('id', $user_id)
                ->delete();
            DB::table('utilizadores')
                ->where('id', $user_id)
                ->delete();
            DB::table('aluno_curso')
                ->where('aluno_id', $user_id)
                ->delete();
            DB::table('cadeira_docente', $user_id)
                ->where('docente_id')
                ->delete();


            $users = User::all();
            return redirect()->route('gerirutilizadores', compact('users'));

        }


        DB::table('alunos')
            ->where('id', $user_id)
            ->delete();
        DB::table('docentes')
            ->where('id', $user_id)
            ->delete();
        DB::table('administradores')
            ->where('id', $user_id)
            ->delete();

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

        DB::table('utilizadores')
            ->where('id', $user_id)
            ->update(['name' => $user_name, 'email'=> $user_email, "identificacao_uma" => $identificacao_uma]);
        /*
        if(strpos($permissions, 'admin')) {
            if (DB::Table('administradores')->find(Auth::user()->id) == null)
                DB::table('administradores')
                    ->insert(['id' => $user_id]);
        }else{
                DB::table('administradores')
                    ->where('id', $user_id)
                    ->delete();
        }
        if(strpos($permissions, 'aluno')) {
            return 'lol';
            if (DB::Table('alunos')->find(Auth::user()->id) == null)
                DB::table('alunos')
                    ->insert(['id' => $user_id]);
        }else{
                DB::table('alunos')
                    ->where('id', $user_id)
                    ->delete();
        }
        */
        /*
        if(strpos($permissions, 'docente')) {
            if (DB::Table('docentes')->find(Auth::user()->id) == null)
                DB::table('docentes')
                    ->insert(['id' => $user_id]);
        }else{
                DB::table('docentes')
                    ->where('id', $user_id)
                    ->delete();
        }*/

        $users = User::all();
        return redirect()->route('gerirutilizadores', compact('users'));
    }
}

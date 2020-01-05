<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;


class Settings extends Controller
{
    //
    function index(){
        return view('settings');
    }

    function changePassword(){
        $senha_antiga = Input::get('old_password');
        $senha = Input::get('password');
        if(Hash::check($senha_antiga, Auth::User()->password)) {
            $user_id = Auth::User()->id;
            $obj_user = User::find($user_id);
            $obj_user->password = Hash::make($senha);
            if ($obj_user->save())
                return view('home');
        }
            return view('settings');
    }
}

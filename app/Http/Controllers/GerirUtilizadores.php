<?php

namespace App\Http\Controllers;

use App\User;
use View;
use Illuminate\Http\Request;

class GerirUtilizadores extends Controller
{
    //
    function index(){
        $users = User::all();
        return View::make('gerirutilizadores', compact('users'));
    }
}

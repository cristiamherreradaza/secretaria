<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function listado()
    {
        $usuarios = User::all();
        // dd($usuarios);
        return view('user.listado')->with(compact('usuarios'));
    }
}

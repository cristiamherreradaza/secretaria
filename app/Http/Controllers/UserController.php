<?php

namespace App\Http\Controllers;

use App\User;
use App\Unidade;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function listado()
    {
        $usuarios = User::all();
        // dd($usuarios);
        $unidades = Unidade::all();

        return view('user.listado')->with(compact('usuarios', 'unidades'));
    }
}

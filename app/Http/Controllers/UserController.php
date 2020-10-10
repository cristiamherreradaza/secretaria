<?php

namespace App\Http\Controllers;

use App\User;
use App\Unidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function listado()
    {
        $usuarios = User::all();
        // dd($usuarios);
        $unidades = Unidade::all();

        return view('user.listado')->with(compact('usuarios', 'unidades'));
    }

    public function guarda(Request $request)
    {
        $usuario             = new User();
        $usuario->name       = $request->nombre;
        $usuario->unidade_id = $request->unidade_id;
        $usuario->rol        = $request->rol;
        $usuario->password   = Hash::make($request->password);
        $usuario->email      = $request->email;
        $usuario->save();

        return redirect('User/listado');
    }
}

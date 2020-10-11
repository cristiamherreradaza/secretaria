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
        // dd($request->all());
        if($request->id != null){
            $usuario = User::find($request->id);
        }else{
            $usuario = new User();
        }
        if($request->password != null){
            $usuario->password = Hash::make($request->password);
        }
        $usuario->name       = $request->nombre;
        $usuario->unidade_id = $request->unidade_id;
        $usuario->rol        = $request->rol;
        $usuario->email      = $request->email;
        $usuario->save();

        return redirect('User/listado');
    }

    public function eliminar(Request $request, $usuarioId)
    {
        User::destroy($usuarioId);
        return redirect('User/listado');
    }
}

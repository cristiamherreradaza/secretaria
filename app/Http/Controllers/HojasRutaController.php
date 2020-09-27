<?php

namespace App\Http\Controllers;

use App\Hojas_ruta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HojasRutaController extends Controller
{
    public function registro()
    {
        // echo "hojas desde hojas ruta";
        return view('hojasruta.registro');
    }

    public function guarda(Request $request)
    {
        $hr = new Hojas_ruta();
        $hr->user_id = Auth::user()->id;
        $hr->unidad_solicitante = $request->unidad_solicitante;
        $hr->fecha = $request->fecha;
        $hr->detalle = $request->detalle;
        $hr->observacion = $request->observacion;
        $hr->save();
    }

    public function listado()
    {
        return view('hojasruta.listado');
    }

    public function ajax_listado()
    {

    }


}

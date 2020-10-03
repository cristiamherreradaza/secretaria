<?php

namespace App\Http\Controllers;

use DataTables;
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
        $hr->user_id            = Auth::user()->id;
        $hr->unidad_solicitante = $request->unidad_solicitante;
        $hr->hoja_ruta          = $request->hoja_ruta;
        $hr->fecha              = $request->fecha;
        $hr->detalle            = $request->detalle;
        $hr->observacion        = $request->observacion;
        $hr->save();
    }

    public function listado()
    {
        return view('hojasruta.listado');
    }

    public function ajax_listado()
    {
        $hr = Hojas_ruta::select(
                            'hojas_rutas.id',
                            'hojas_rutas.hoja_ruta',
                            'hojas_rutas.hoja_ruta'
                        )->orderBy('id', 'desc');

        return Datatables::of($hr)->addColumn('action', function ($hr) {
            return '<button type="button" class="btn btn-info" title="Ver pedido" onclick="ver_pedido(' . $hr->id . ')"><i class="fas fa-eye"></i></button>
                                    <button type="button" class="btn btn-success" title="Bajar pedido en Excel"  onclick="excel(' . $hr->id . ')"><i class="fas fa-file-excel"></i></button>';
        })->make(true);

    }

    public function secretaria()
    {
        
    }


}

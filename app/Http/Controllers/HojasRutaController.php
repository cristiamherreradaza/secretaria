<?php

namespace App\Http\Controllers;

use DataTables;
use App\Unidade;
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
        $hr->user_id             = Auth::user()->id;
        $hr->unidad_solicitante  = $request->unidad_solicitante;
        $hr->hoja_ruta           = $request->hoja_ruta;
        $hr->fecha               = $request->fecha;
        $hr->detalle             = $request->detalle;
        $hr->obs_correspondencia = $request->observacion;
        $hr->save();

        return redirect('HojasRuta/listado');
    }

    public function listado()
    {
        return view('hojasruta.listado');
    }

    public function ajax_listado()
    {
        $hr = Hojas_ruta::select(
                            'hojas_rutas.id',
                            'users.name as nombre',
                            'hojas_rutas.hoja_ruta',
                            'hojas_rutas.fecha',
                            'hojas_rutas.unidad_solicitante',
                            'hojas_rutas.detalle'
                        )
                        ->leftJoin('users', 'hojas_rutas.user_id', '=', 'users.id')
                        ->orderBy('id', 'desc');

        return Datatables::of($hr)->addColumn('action', function ($hr) {
            return '<button type="button" class="btn btn-info" title="Asignar" onclick="asignar(' . $hr->id . ')"><i class="fas fa-arrow-alt-circle-right"></i></button>
                    <button type="button" class="btn btn-warning" title="Editar"  onclick="editar(' . $hr->id . ')"><i class="fas fa-pencil-alt"></i></button>
                    <button type="button" class="btn btn-danger" title="Eliminar"  onclick="eliminar(' . $hr->id . ')"><i class="fas fa-times"></i></button>';
        })->make(true);

    }

    public function asignar(Request $request, $hrId)
    {
        $datosHojaRuta = Hojas_ruta::where('id', $hrId)->first();
        $unidades = Unidade::all();
        // dd($datosHojaRuta);
        return view('hojasruta.asignacion')->with(compact('datosHojaRuta', 'unidades'));
    }

    public function guardaAsignacion(Request $request)
    {
        $hojaRuta = Hojas_ruta::find($request->hojaRutaId);
        $hojaRuta->unidade_id     = $request->unidade_id;
        $hojaRuta->obs_asignacion = $request->observacion;
        $hojaRuta->save();

        return redirect('HojasRuta/asignados');
    }

    public function asignados()
    {
        return view('hojasruta.asignados');
    }

    public function ajax_asignados()
    {
        $hr = Hojas_ruta::select(
                            'hojas_rutas.id',
                            'users.name as nombre',
                            'hojas_rutas.hoja_ruta',
                            'unidades.nombre as unidad',
                            'hojas_rutas.fecha',
                            'hojas_rutas.unidad_solicitante',
                            'hojas_rutas.detalle'
                        )
                        ->leftJoin('users', 'hojas_rutas.user_id', '=', 'users.id')
                        ->leftJoin('unidades', 'hojas_rutas.unidade_id', '=', 'unidades.id')
                        ->orderBy('id', 'desc');

        return Datatables::of($hr)->addColumn('action', function ($hr) {
            return '<button type="button" class="btn btn-info" title="Asignar" onclick="asignar(' . $hr->id . ')"><i class="fas fa-arrow-alt-circle-right"></i></button>
                    <button type="button" class="btn btn-warning" title="Editar"  onclick="editar(' . $hr->id . ')"><i class="fas fa-pencil-alt"></i></button>
                    <button type="button" class="btn btn-danger" title="Eliminar"  onclick="eliminar(' . $hr->id . ')"><i class="fas fa-times"></i></button>';
        })->make(true);

    }

}

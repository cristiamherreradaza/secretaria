@extends('layouts.app')

@section('css')
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endsection

@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card border-primary">
            <div class="card-header bg-primary">
                <h4 class="mb-0 text-white">ASIGNACION CORRESPONDENCIA</h4>
            </div>
            <div class="card-body">
                <div class="row justify-content-md-center">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">
                                Hoja de Ruta
                                <span class="text-danger">
                                    <i class="mr-2 mdi mdi-alert-circle"></i>
                                </span>
                            </label>
                            {{-- <input type="text" name="hoja_ruta" id="hoja_ruta" class="form-control" value="{{ $datosHojaRuta->hoja_ruta }}" readonly />
                            <button type="button" class="btn btn-danger" title="Eliminar" onclick="eliminar()"><i class="fas fa-times"></i></button> --}}

                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1" value="{{ $datosHojaRuta->hoja_ruta }}" readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-info" type="button" onclick="adjuntaHr()"><i class="fas fa-paperclip"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">
                                Fecha
                                <span class="text-danger">
                                    <i class="mr-2 mdi mdi-alert-circle"></i>
                                </span>
                            </label>
                            <input type="text" name="fecha" id="fecha" class="form-control" value="{{ $datosHojaRuta->fecha }}" readonly />
                        </div>
                    </div>
                </div>
                
                <div class="row justify-content-md-center">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">
                                Unidad Solicitante
                                <span class="text-danger">
                                    <i class="mr-2 mdi mdi-alert-circle"></i>
                                </span>
                            </label>
                            <input type="text" name="unidad_solicitante" id="unidad_solicitante" class="form-control" value="{{ $datosHojaRuta->unidad_solicitante }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">
                                Detalle
                                <span class="text-danger">
                                    <i class="mr-2 mdi mdi-alert-circle"></i>
                                </span>
                            </label>
                            <input type="text" name="detalle" id="detalle" class="form-control" value="{{ $datosHojaRuta->detalle }}" readonly>
                        </div>
                    </div>
                </div>
                
                <div class="row justify-content-md-center">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="control-label">Observaciones</label>
                            <input type="text" name="observacion" id="observacion" class="form-control" value="{{ $datosHojaRuta->observacion }}" readonly>
                        </div>
                    </div>
                </div>

                <h4 class="text-center">ASIGNACION</h4>
                
                <form action="{{ url('HojasRuta/guardaAsignacion') }}" method="POST" id="formularioRegistro" enctype="multipart/form-data" />
                    @csrf
                    <div class="row justify-content-md-center">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">
                                    Asignar
                                    <span class="text-danger">
                                        <i class="mr-2 mdi mdi-alert-circle"></i>
                                    </span>
                                </label>
                                <input type="hidden" name="hojaRutaId" value="{{ $datosHojaRuta->id }}">
                                <select name="unidade_id" id="unidade_id" class="form-control">
                                    @foreach($unidades as $u)
                                    <option value="{{ $u->id }}">{{ $u->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">
                                    Adjuntar archivos
                                </label>
                                <input type="file" id="archivos" class="form-control" name="archivos[]" multiple />
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Observaciones</label>
                                <input type="text" name="observacion" id="observacion" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                            <button class="btn btn-primary btn-block" type="button" id="btnEsperaRegistro"
                                style="display: none;" disabled>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Cargando...
                            </button>
                            <button type="button" id="btnRegistra"
                                class="btn waves-effect waves-light btn-block btn-success text-white"
                                onclick="registraHr();">ASIGNAR CORRESPONDENCIA</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@stop
@section('js')
<script src="{{ asset('assets/libs/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dist/js/pages/datatable/custom-datatable.js') }}"></script>
<script>
    $.ajaxSetup({
        // definimos cabecera donde estarra el token y poder hacer nuestras operaciones de put,post...
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).ready(function () {

    });

    function registraHr()
    {
        if ($("#formularioRegistro")[0].checkValidity()) 
        {
            $("#btnRegistra").toggle();
            $("#btnEsperaRegistro").toggle();

            $("#formularioRegistro").submit();
            Swal.fire({
                type: 'success',
                title: 'Excelente',
                text: 'Se registro'
            });

        }else{
            $("#formularioRegistro")[0].reportValidity();
        }
    }

    function adjuntaHr()
    {
        console.log("entro");
    }

</script>

@endsection
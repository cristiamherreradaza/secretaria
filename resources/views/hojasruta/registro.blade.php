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
        <div class="card border-info">
            <div class="card-header bg-info">
                <h4 class="mb-0 text-white">NUEVA CORRESPONDENCIA</h4>
            </div>
            <div class="card-body">
                <form action="{{ url('HojasRuta/guarda') }}" method="POST" id="formularioRegistro">
                    @csrf
                    <div class="row justify-content-md-center">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">
                                    Hoja de Ruta
                                    <span class="text-danger">
                                        <i class="mr-2 mdi mdi-alert-circle"></i>
                                    </span>
                                </label>
                                <input type="text" name="hoja_ruta" id="hoja_ruta" class="form-control" required autofocus />
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
                                <input type="date" name="fecha" id="fecha" class="form-control" value="{{ date("Y-m-d") }}" required>
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
                                <input type="text" name="unidad_solicitante" id="unidad_solicitante" class="form-control" required autocomplete="on">
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
                                <input type="text" name="detalle" id="detalle" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Observaciones</label>
                                <input type="text" name="observacion" id="observacion" class="form-control" >
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                            <button class="btn btn-primary btn-block" type="button" id="btnEsperaRegistro" style="display: none;" disabled>
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Cargando...
                            </button>
                            <button type="button" id="btnRegistra" class="btn waves-effect waves-light btn-block btn-success text-white" onclick="registraHr();">REGISTRAR CORRESPONDENCIA</button>
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
        if ($("#formularioRegistro")[0].checkValidity()) {
            $("#btnRegistra").toggle();
            $("#btnEsperaRegistro").toggle();
0        }else{
            $("#formularioRegistro")[0].reportValidity();
        }
    }

</script>

@endsection
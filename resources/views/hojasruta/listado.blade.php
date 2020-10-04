@extends('layouts.app')

@section('css')
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
<link href="{{ asset('assets/libs/dropzone/dist/min/dropzone.min.css') }}" rel="stylesheet">
@endsection

@section('metadatos')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
<div id="divmsg" style="display:none" class="alert alert-primary" role="alert"></div>
<div class="row">
    <!-- Column -->

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">LISTADO DE HOJAS RUTA </h4>
                <table id="tabla-hojas" class="table table-bordered table-striped no-wrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>Hoja</th>
                            <th>Ingreso</th>
                            <th>Unidad</th>
                            <th>Detalle</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
@stop
@section('js')
<script src="{{ asset('assets/libs/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dist/js/pages/datatable/custom-datatable.js') }}"></script>
<script src="{{ asset('assets/libs/dropzone/dist/min/dropzone.min.js') }}"></script>

<script>
    $(document).ready(function() {
    // DataTable
    var table = $('#tabla-hojas').DataTable( {
        
            iDisplayLength: 10,
            processing: true,
            // scrollX: true,
            serverSide: true,
            ajax: "{{ url('HojasRuta/ajax_listado') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'nombre', name: 'users.name'},
                {data: 'hoja_ruta', name: 'hoja_ruta'},
                {data: 'fecha', name: 'fecha'},
                {data: 'unidad_solicitante', name: 'unidad_solicitante'},
                {data: 'detalle', name: 'detalle'},
                {data: 'action'},
            ],
            language: {
                url: '{{ asset('datatableEs.json') }}'
            },
        } );

    } );

    function asignar(id)
    {
        window.location.href = "{{ url('HojasRuta/asignar') }}/"+id;
    }

</script>

@endsection
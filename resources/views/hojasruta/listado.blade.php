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
                            <th>Fecha</th>
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

</script>
<script>
    function entrega_excel(id)
    {
        $("#pedido_id").val(id);
        $("#entrega_excel").modal('show');
    }

    function ver_pedido(id)
    {
        window.location.href = "{{ url('Entrega/ver_pedido') }}/"+id;
    }
    
</script>
<script>
    // Script de importacion de excel
$(document).ready(function() {
    $('.upload_form').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: "{{ url('Entrega/importar_envio') }}",
            method: "POST",
            data: new FormData(this), pedido_id,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function(data)
            {
                if(data.sw == 1){
                    Swal.fire(
                    'Hecho',
                    data.message,
                    'success'
                    )
                    .then(function() {
                        window.location.href = "{{ url('Entrega/ver_pedido') }}/"+data.numero;
                    });
                }else{
                    Swal.fire(
                    'Oops...',
                    data.message,
                    'error'
                    )
                }
            }
        })
    });
});
</script>
<script>
    function editar(id)
    {
        $("#id").val(id);
        window.location.href = "{{ url('Pedido/editar') }}/"+id;
    }

    function eliminar(id)
    {
        Swal.fire({
            title: 'Estas seguro de eliminar este pedido?',
            text: "Luego no podras recuperarlo!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, estoy seguro!',
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                    'Excelente!',
                    'El pedido fue eliminado',
                    'success'
                ).then(function() {
                    window.location.href = "{{ url('Pedido/eliminar') }}/"+id;
                });
            }
        })
    }
    
    function entrega(id)
    {
        window.location.href = "{{ url('Entrega/entrega') }}/"+id;
    }
    function excel(id)
    {
        window.location.href = "{{ url('Entrega/excel') }}/"+id;
    }
</script>
@endsection
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
                                <input type="text" name="unidad_solicitante" id="unidad_solicitante" class="form-control" required>
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
                            <button type="submit" class="btn waves-effect waves-light btn-block btn-success text-white">REGISTRAR CORRESPONDENCIA</button>
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
    var totalImporte = 0;

    var cantidad = document.getElementById('cantidad');
    cantidad.addEventListener('keyup', multiplicaCantidad);

    var precio = document.getElementById('precio');
    precio.addEventListener('keyup', multiplicaPrecio);

    $.ajaxSetup({
        // definimos cabecera donde estarra el token y poder hacer nuestras operaciones de put,post...
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).ready(function () {
        $('#tablaPedido tbody').on('click', '.btnElimina', function () {
            t.row($(this).parents('tr'))
                .remove()
                .draw();
            let itemBorrar = $(this).closest("tr").find("td:eq(0)").text();
        });

    });

    var t = $('#tablaPedido').DataTable({
        paging: false,
        searching: false,
        ordering:  false,   
        info: false,
        language: {
            url: '{{ asset('datatableEs.json') }}'
        },
    });

    function multiplicaCantidad()
    {
        let cantidad = document.getElementById("cantidad").value;
        let precio = document.getElementById("precio").value;
        document.getElementById("subtotal").value=cantidad*precio;
        // console.log(cantidad*precio);
    }

    function multiplicaPrecio()
    {
        let cantidad = document.getElementById("cantidad").value;
        let precio = document.getElementById("precio").value;
        document.getElementById("subtotal").value=cantidad*precio;
    }

    function adicionar()
    {
        let producto = document.getElementById("producto").value;
        let cantidad = document.getElementById("cantidad").value;
        let precio   = document.getElementById("precio").value;
        let subtotal = document.getElementById("subtotal").value;
        
        totalImporte = Number(totalImporte) + Number(subtotal); 
        document.getElementById("montoTotal").innerHTML = totalImporte;
        document.getElementById("totalVenta").value = totalImporte;

        t.row.add([
            `<input type="text" name="producto[]" value="`+producto+`" class="form-control" readonly >`,
            `<input type="text" name="cantidad[]" value="`+cantidad+`" class="form-control text-right" style="width: 80px;" readonly >`,
            `<input type="text" name="precio[]" value="`+precio+`" class="form-control text-right" style="width: 80px;" readonly >`,
            `<input type="text" name="subtotal[]" value="`+subtotal+`" class="form-control text-right" style="width: 80px;" readonly >`,
            '<button type="button" class="btnElimina btn btn-danger" title="Elimina Producto"><i class="fas fa-trash-alt"></i></button>'
        ]).draw(false);
        // console.log(producto);

        document.getElementById("producto").value = "";
        document.getElementById("cantidad").value = "";
        document.getElementById("precio").value = "";
        document.getElementById("subtotal").value = "";

        document.getElementById("producto").focus();
        

    }

</script>

@endsection
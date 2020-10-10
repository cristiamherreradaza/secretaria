@extends('layouts.app')

@section('css')
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="card border-info">
    <div class="card-header bg-info">
        <h4 class="mb-0 text-white">
            USUARIOS &nbsp;&nbsp;
            <button type="button" class="btn waves-effect waves-light btn-sm btn-warning" onclick="nuevo()"><i
                    class="fas fa-plus"></i> &nbsp; NUEVO USUARIO</button>
        </h4>
    </div>
    <div class="card-body" id="lista">
        <div class="table-responsive m-t-40">
            <table id="myTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Unidad</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $key => $usuario)
                    <tr>
                        <td>{{ ($key+1) }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->rol }}</td>
                        <td>{{ $usuario->unidade->nombre }}</td>
                        <td>
                            <button type="button" class="btn btn-warning" title="Editar usuarios"
                                onclick="editar('{{ $usuario->id }}', '{{ $usuario->name }}', '{{ $usuario->email }}', '{{ $usuario->rol }}', '{{ $usuario->unidade_id }}')"><i
                                    class="fas fa-edit"></i></button>
                            <button type="button" class="btn btn-danger" title="Eliminar usuarios"
                                onclick="eliminar('{{ $usuario->id }}', '{{ $usuario->name }}')"><i
                                    class="fas fa-trash-alt"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- inicio modal nuevo usuario -->
<div id="nuevo" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">NUEVO USUARIO</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="{{ url('User/guarda') }}" method="POST" id="formularioUsuario">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Nombre</label>
                                <span class="text-danger">
                                    <i class="mr-2 mdi mdi-alert-circle"></i>
                                </span>
                                <input type="hidden" name="id" id="id">
                                <input name="nombre" type="text" id="nombre" class="form-control"
                                    required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Email</label>
                                <span class="text-danger">
                                    <i class="mr-2 mdi mdi-alert-circle"></i>
                                </span>
                                <input name="email" type="text" id="email" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Password</label>
                                <span class="text-danger" id="advertenciaPass">
                                    <i class="mr-2 mdi mdi-alert-circle"></i>
                                </span>
                                <input name="password" type="text" id="password" class="form-control" required>
                            </div>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">
                                    Rol
                                    <span class="text-danger">
                                        <i class="mr-2 mdi mdi-alert-circle"></i>
                                    </span>
                                </label>
                                <select name="rol" id="rol" class="form-control">
                                    <option value="Administrador">Administrador</option>
                                    <option value="Secretaria">Secretaria</option>
                                    <option value="Mensajero">Mensajero</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">
                                    Unidad
                                    <span class="text-danger">
                                        <i class="mr-2 mdi mdi-alert-circle"></i>
                                    </span>
                                </label>
                                <select name="unidade_id" id="unidade_id" class="form-control">
                                    @foreach($unidades as $u)
                                    <option value="{{ $u->id }}">{{ $u->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn waves-effect waves-light btn-block btn-success" onclick="guardar()">GUARDAR</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- fin modal nueva categoria -->

<!-- inicio modal editar categoria -->
<div id="editar_categorias" class="modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">EDITAR CATEGORIA</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <form action="{{ url('Categoria/actualizar') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Nombre</label>
                                <span class="text-danger">
                                    <i class="mr-2 mdi mdi-alert-circle"></i>
                                </span>
                                <input name="nombre" type="text" id="nombre" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn waves-effect waves-light btn-block btn-success"
                        onclick="actualizar_categoria()">ACTUALIZAR CATEGORIA</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- fin modal editar categoria -->

@stop

@section('js')
<script src="{{ asset('assets/libs/datatables/media/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dist/js/pages/datatable/custom-datatable.js') }}"></script>
<script>
    $(function () {
        $('#myTable').DataTable({
            language: {
                url: '{{ asset('datatableEs.json') }}'
            },
        });

    });
</script>
<script>
    function nuevo()
    {
        $("#id").val('');
        $("#nombre").val('');
        $("#email").val('');
        $("#rol").val('');
        $("#password").val('');
        $("#unidade_id").val('');

        $("#nuevo").modal('show');
    }

    function guardar()
    {
        if ($("#formularioUsuario")[0].checkValidity()) {
            $("#formularioUsuario").submit();
            Swal.fire(
                'Excelente!',
                'Usuario registrado.',
                'success'
            )

        }else{
            $("#formularioUsuario")[0].reportValidity();
        }
        // var nombre_categoria = $("#nombre_categoria").val();
    }

    function editar(id, nombre, email, rol, unidad)
    {
        $("#id").val(id);
        $("#nombre").val(nombre);
        $("#email").val(email);
        $("#rol").val(rol);
        $("#unidade_id").val(unidad);
        $("#advertenciaPass").hide();
        $("#password").removeAttr('required');
        $("#nuevo").modal('show');
    }

    function actualizar_categoria()
    {
        var id = $("#id").val();
        var nombre = $("#nombre").val();
        if(nombre.length>0){
            Swal.fire(
                'Excelente!',
                'Categoria actualizada correctamente.',
                'success'
            )
        }
    }

    function eliminar(id, nombre)
    {
        Swal.fire({
            title: 'Quieres borrar ' + nombre + '?',
            text: "Luego no podras recuperarlo!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, estoy seguro!',
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.value) {
                window.location.href = "{{ url('User/eliminar') }}/"+id;
                Swal.fire(
                    'Excelente!',
                    'La categoria fue eliminada',
                    'success'
                );
            }
        })
    }
</script>
@endsection
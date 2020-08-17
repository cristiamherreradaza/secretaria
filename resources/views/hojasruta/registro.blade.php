@extends('layouts.app')

@section('css')
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="card border-info">
    <div class="card-header bg-info">
        <h4 class="mb-0 text-white">
            REGISTRO DE HOJA DE RUTA
        </h4>
    </div>
    <div class="card-body" id="lista">
        
    </div>
</div>
@endsection
@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="container py-5">
    <h1 class="text-center mb-4">Bienvenido al Backoffice</h1>

    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Propiedades</h5>
                    <p class="card-text">Total de propiedades: 25</p>
                    <a href="{{ route('admin.properties.index') }}" class="btn btn-main">Ver propiedades</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Usuarios</h5>
                    <p class="card-text">Total de usuarios: 100</p>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-main">Ver usuarios</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informes</h5>
                    <p class="card-text">Ver informes de ventas y visitas.</p>
                    <a href="{{ route('admin.reports') }}" class="btn btn-main">Ver informes</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Configuración</h5>
                    <p class="card-text">Modificar configuración de la plataforma.</p>
                    <a href="{{ route('admin.settings') }}" class="btn btn-main">Ver configuración</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

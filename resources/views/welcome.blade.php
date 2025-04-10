@extends('layouts.guest')

@section('title', 'Inicio')

@section('content')
    {{-- Hero principal --}}
    <section class="position-relative bg-dark text-white" style="height: 80vh; background: url('/images/hero.jpg') center center / cover no-repeat;">
        <div class="container h-100 d-flex align-items-center justify-content-center">
            <div class="text-center">
                <h1 class="display-4 fw-light">Descubre propiedades exclusivas</h1>
                <p class="lead">En los destinos más deseados</p>

                {{-- Buscador --}}
                <form action="{{ route('search') }}" method="GET" class="row g-2 mt-4 bg-white p-3 rounded shadow text-dark">
                    <div class="col-md-3">
                        <input type="text" name="location" class="form-control" placeholder="Ubicación">
                    </div>
                    <div class="col-md-3">
                        <select name="type" class="form-select">
                            <option value="">Tipo de propiedad</option>
                            <option value="piso">Piso</option>
                            <option value="casa">Casa</option>
                            <option value="villa">Villa</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="min_price" class="form-control" placeholder="Desde €">
                    </div>
                    <div class="col-md-2">
                        <input type="number" name="max_price" class="form-control" placeholder="Hasta €">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-dark w-100">Buscar</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    {{-- Sección futura: propiedades destacadas --}}
    <section class="container py-5">
        <h2 class="mb-4 text-center">Propiedades destacadas</h2>
        {{-- Aquí irán las tarjetas de propiedades --}}
        <div class="row">
            {{-- Ejemplo de tarjeta --}}
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm">
                    <img src="/images/example.jpg" class="card-img-top" alt="Propiedad">
                    <div class="card-body">
                        <h5 class="card-title">Villa en Marbella</h5>
                        <p class="card-text">€2.500.000 · 4 hab · 3 baños</p>
                        <a href="#" class="btn btn-outline-dark btn-sm">Ver más</a>
                    </div>
                </div>
            </div>
            {{-- Fin ejemplo --}}
        </div>
    </section>
@endsection

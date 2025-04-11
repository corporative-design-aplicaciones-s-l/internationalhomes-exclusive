@extends('layouts.guest')

@section('title', $zona->nombre)

@section('content')
    <!-- Hero con imagen principal -->
    <section class="hero-image position-relative" style="height: 400px; overflow: hidden;">
        <img src="{{ asset('storage/' . $zona->imagen_principal) }}" alt="{{ $zona->nombre }}"
            class="w-100 h-100" style="object-fit: cover;">
        <div class="position-absolute top-50 start-50 translate-middle text-white text-center">
            <h1 class="display-4 fw-semibold text-shadow bg-dark bg-opacity-50 px-4 py-2 rounded">
                {{ $zona->nombre }}
            </h1>
        </div>
    </section>

    <!-- Secciones dentro de la zona -->
    <section class="container py-5">
        @foreach ($zona->secciones as $seccion)
            <div class="row align-items-center mb-5">
                <div class="col-md-6">
                    <img src="{{ asset('storage/' . $seccion->imagen) }}" alt="{{ $seccion->titulo }}"
                        class="img-fluid rounded shadow-sm">
                </div>
                <div class="col-md-6 mt-3 mt-md-0">
                    <h3 class="fw-semibold">{{ $seccion->titulo }}</h3>
                    <p class="text-muted" style="white-space: pre-line;">
                        {{ $seccion->descripcion }}
                    </p>
                </div>
            </div>
        @endforeach
    </section>
@endsection

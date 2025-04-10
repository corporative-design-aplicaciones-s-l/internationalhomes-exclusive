@extends('layouts.guest')

@section('title', 'Entorno de la propiedad')

@section('style')
    .hero-image {
    position: relative;
    background-color: #2d3e50;
    }

    .hero-image h1 {
    font-size: 3rem;
    text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.6);
    }

    section {
    padding: 60px 0;
    }

    section h2 {
    font-weight: 600;
    }

    section p {
    color: #555;
    }

    section ul {
    padding-left: 20px;
    }

    section ul li {
    font-size: 1rem;
    color: #333;
    margin-bottom: 10px;
    }

    .card {
    position: relative;
    overflow: hidden;
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-img-top {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
    }

    .card-img-top:hover {
    transform: scale(1.05);
    }

    .card-img-overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    }

    .stretched-link {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    }

@endsection

@section('content')
    <section class="hero-image"
        style="background: url('/images/environment-hero.jpg') no-repeat center center; background-size: cover; height: 60vh;">
        <div class="container d-flex align-items-center h-100">
            <h1 class="text-white fw-light">Conoce el entorno</h1>
        </div>
    </section>

    <section class="container py-5">
        <p class="text-center mb-5">
            La Costa Blanca Norte, desde Dénia hasta Altea, es conocida como una de las zonas más hermosas del mundo para
            vivir, disfrutar y descansar. Cada zona es única y ofrece una experiencia especial para aquellos que buscan
            calidad de vida en un entorno incomparable.
        </p>
    </section>

    {{-- Ubicaciones --}}

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($locations as $location => $image)
            <div class="col">
                <div class="card position-relative">
                    <img src="{{ $image }}" class="card-img-top" alt="{{ $location }}">
                    <div class="card-img-overlay d-flex justify-content-center align-items-center">
                        <h4 class="text-white fw-semibold"
                            style="background-color: rgba(0, 0, 0, 0.6); padding: 10px 20px; border-radius: 5px;">
                            {{ $location }}</h4>
                    </div>
                    <a href="{{ route('location.show', ['slug' => Str::slug($location)]) }}" class="stretched-link"></a>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Mapa interactivo --}}
    <section class="container py-5">
        <h2 class="text-center mb-4">Mapa interactivo</h2>
        <div id="map" style="height: 400px;"></div> <!-- Mapa se insertará aquí -->
    </section>

@endsection

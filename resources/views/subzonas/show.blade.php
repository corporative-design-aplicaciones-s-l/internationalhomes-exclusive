@extends('layouts.guest')

@section('title', $subzona->nombre)

@section('style')
    <link href="{{ asset('css/lightbox.css') }}" rel="stylesheet">
@endsection

@section('content')
    <section class="py-5 bg-light">
        <div class="container">
            <h1 class="mb-4">{{ $subzona->nombre }}</h1>
            <p class="lead">{{ $subzona->resumen }}</p>

            {{-- Imagen principal --}}
            <img src="{{ asset('storage/' . $subzona->imagen_destacada) }}" class="img-fluid rounded shadow-sm mb-4" alt="{{ $subzona->nombre }}">

            {{-- Galería --}}
            @if($subzona->imagenes && count($subzona->imagenes))
                <div class="row g-3 mb-5">
                    @foreach($subzona->imagenes as $imagen)
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="{{ asset('storage/' . $imagen->path) }}" class="glightbox" data-gallery="subzona-gallery">
                                <img src="{{ asset('storage/' . $imagen->path) }}" class="img-fluid rounded shadow-sm" alt="Imagen galería">
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- Características destacadas --}}
            <div class="table-responsive mb-5">
                <table class="table table-bordered">
                    <tbody>
                        @if($subzona->superficie)
                            <tr>
                                <th>Superficie</th>
                                <td>{{ $subzona->superficie }} m²</td>
                            </tr>
                        @endif
                        @if($subzona->habitaciones)
                            <tr>
                                <th>Habitaciones</th>
                                <td>{{ $subzona->habitaciones }}</td>
                            </tr>
                        @endif
                        @if($subzona->banos)
                            <tr>
                                <th>Baños</th>
                                <td>{{ $subzona->banos }}</td>
                            </tr>
                        @endif
                        @if($subzona->precio_desde)
                            <tr>
                                <th>Precio desde</th>
                                <td>€{{ number_format($subzona->precio_desde, 0, ',', '.') }}</td>
                            </tr>
                        @endif
                        @if($subzona->estado)
                            <tr>
                                <th>Estado</th>
                                <td>{{ $subzona->estado }}</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            {{-- Botón contacto --}}
            <div class="text-center my-5">
                <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" class="btn btn-main btn-lg">
                    <i class="bi bi-envelope me-2"></i> Solicitar información
                </a>
            </div>

            {{-- Propiedades relacionadas --}}
            @if($subzona->properties->count())
                <h2 class="h4 mb-4">Propiedades disponibles</h2>
                <div class="row gx-4 gy-4">
                    @foreach($subzona->properties as $property)
                        <div class="col-md-6 col-lg-4">
                            @include('partials.property.card', ['property' => $property])
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{ asset('js/glightbox.min.js') }}"></script>
    <script>
        const lightbox = GLightbox({ selector: '.glightbox' });
    </script>
@endsection

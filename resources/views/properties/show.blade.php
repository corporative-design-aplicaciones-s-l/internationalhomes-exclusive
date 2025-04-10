@extends('layouts.guest')

@section('title', $property->title)

@section('style')
    <link href="{{ asset('css/properties.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container py-5">
        <div class="row">
            {{-- Galería de imágenes (70%) --}}
            <div class="col-lg-8">
                {{-- Imagen principal (1ª de la galería) --}}
                @php
                    $mainImage = $property->images->first()?->url ?? $property->image;
                @endphp

                <a href="{{ $mainImage }}" class="glightbox position-relative d-block overflow-hidden"
                    data-gallery="property-gallery" style="aspect-ratio: 4/3;">
                    <img id="mainImage" src="{{ $mainImage }}" class="w-100 h-100" style="object-fit: cover;"
                        alt="{{ $property->title }}">
                    {{-- Icono lupa como antes --}}
                </a>

                {{-- Miniaturas debajo --}}
                <div class="row g-2 mt-2">
                    @foreach ($property->images as $index => $img)
                        <div class="col-3">
                            <a href="{{ $img->url }}" class="glightbox" data-gallery="property-gallery"
                                onclick="event.preventDefault(); document.getElementById('mainImage').src='{{ $img->url }}'">
                                <img src="{{ $img->url }}" class="w-100 border"
                                    style="cursor: pointer; aspect-ratio: 1/1; object-fit: cover;"
                                    alt="Miniatura {{ $index + 1 }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Formulario + Info --}}
            <div class="col-lg-4">
                {{-- Formulario --}}
                <div class="border rounded p-4 shadow-sm mb-4">
                    <h5 class="mb-4">Solicita información</h5>
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Tu nombre completo *</label>
                            <input type="text" name="name" class="form-control" placeholder="p.ej: María">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tu email *</label>
                            <input type="email" name="email" class="form-control" placeholder="p.ej: nombre@email.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tu teléfono *</label>
                            <input type="tel" name="phone" class="form-control" placeholder="+34">
                        </div>
                        <button type="submit" class="btn btn-dark w-100">Enviar</button>
                    </form>
                </div>

                {{-- Información rápida de propiedad --}}
                <div class="border rounded p-4 shadow-sm">
                    <h5 class="mb-2">{{ $property->title }}</h5>
                    <p class="text-muted">{{ $property->location }}</p>
                    <h4 class="text-primary">€{{ number_format($property->price, 0, ',', '.') }}</h4>

                    <div class="row text-center mt-4">
                        <div class="col-4">
                            <div class="small text-muted">Habitaciones</div>
                            <div class="fw-semibold">{{ $property->bedrooms }}</div>
                        </div>
                        <div class="col-4">
                            <div class="small text-muted">Baños</div>
                            <div class="fw-semibold">{{ $property->bathrooms }}</div>
                        </div>
                        <div class="col-4">
                            <div class="small text-muted">Superficie</div>
                            <div class="fw-semibold">{{ $property->area }} m²</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Descripción completa --}}
        <div class="mt-5">
            <h5 class="fw-semibold">Descripción</h5>
            <p style="white-space: pre-line;">{{ $property->description }}</p>
        </div>
    </div>
@endsection

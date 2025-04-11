@extends('layouts.guest')

@section('title', $property->title)

@section('style')
    <script>
        /* Estilos específicos para la página de propiedades */

        .hero - image {
                background - color: #f1f1f1;
                padding: 50 px 0;
            }

            .card {
                border - radius: 10 px;
                box - shadow: 0 4 px 10 px rgba(0, 0, 0, 0.1);
            }

            .card - img - top {
                width: 100 % ;
                height: 100 % ;
                object - fit: cover;
                transition: transform 0.3 s ease;
            }

            .card - img - top: hover {
                transform: scale(1.05);
            }
    </script>
@endsection

@section('content')

    <div class="container py-5">
        <div class="row">
            {{-- Galería de imágenes (70%) --}}
            <div class="col-lg-8">
                {{-- Imagen principal (1ª de la galería) --}}
                @php
                    $mainImage = $property->thumbnail ? "storage/{$property->thumbnail}" : $property->image;
                @endphp

                <a href="{{ $mainImage }}" class="glightbox position-relative d-block overflow-hidden"
                    data-gallery="property-gallery" style="aspect-ratio: 4/3;">
                    <img id="mainImage" src="{{ asset($mainImage) }}" class="w-100 h-100" style="object-fit: cover;"
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

                {{-- Información rápida de propiedad --}}
                <div class="border rounded p-4 shadow-sm">
                    <h5 class="mb-2">{{ $property->title }}</h5>
                    <p class="text-muted mb-1"><i class="fas fa-map-marker-alt me-1"></i>{{ $property->zona->nombre }}</p>
                    <p class="text-muted small mb-3"></i>Ref:
                        <strong>{{ $property->ref }}</strong>
                    </p>
                    <h4 class="text-primary"><i
                            class="fas fa-euro-sign me-1"></i>{{ number_format($property->price, 0, ',', '.') }}</h4>

                    <hr class="my-3">

                    <div class="row text-center gy-3">
                        <div class="row my-4">
                            {{-- TIPO --}}
                            <div class="col-6">
                                <small class="text-muted"><i class="fas fa-home me-1"></i></small>
                                <div class="fw-semibold">{{ ucfirst($property->tipo ?? 'N/D') }}</div>
                            </div>

                            {{-- UBICACION --}}
                            <div class="col-6">
                                <small class="text-muted"><i class="fas fa-location-dot me-1"></i></small>
                                <div class="fw-semibold">{{ $property->location ?? 'N/D' }}</div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            {{-- HABITACIONES --}}
                            <div class="col-4">
                                <small class="text-muted"><i class="fas fa-bed me-1"></i></small>
                                <div class="fw-semibold">{{ $property->bedrooms ?? '-' }}</div>
                            </div>
                            {{-- BAÑOS --}}
                            <div class="col-4">
                                <small class="text-muted"><i class="fas fa-bath me-1"></i></small>
                                <div class="fw-semibold">{{ $property->bathrooms ?? '-' }}</div>
                            </div>
                            {{-- CONSTRUIDOS --}}
                            <div class="col-4">
                                <small class="text-muted"><i class="fas fa-ruler-combined me-1"></i></small>
                                <div class="fw-semibold">{{ $property->area ?number_format($property->area, 2, ',') :'-' }} m²</div>
                            </div>
                        </div>

                        {{-- SOLAR --}}
                        @if ($property->tiene_solar)
                            <div class="col-6">
                                <small class="text-muted"><i class="fas fa-border-none me-1"></i></small>
                                <div class="fw-semibold">{{ $property->metros_solar ? number_format($property->metros_solar, 2, ',','.') :'-' }} m²</div>
                            </div>
                        @endif

                        @if ($property->tiene_patio)
                            <div class="col-6">
                                <small class="text-muted"><i class="fas fa-seedling me-1"></i>Patio</small>
                                <div class="fw-semibold">Sí</div>
                            </div>
                        @endif

                        @if ($property->tiene_piscina)
                            <div class="col-6">
                                <small class="text-muted"><i class="fas fa-water me-1"></i>Piscina</small>
                                <div class="fw-semibold">Sí</div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Descripción completa --}}
        <div class="row">
            <div class="mt-5">
                <h5 class="fw-semibold">Descripción</h5>
                <p style="white-space: pre-line;">{{ $property->description }}</p>
            </div>
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
        </div>
    </div>
@endsection

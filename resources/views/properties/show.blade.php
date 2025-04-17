@extends('layouts.guest')

@section('title', $property->title)

@section('style')
    <style>
        html {
            scroll-behavior: smooth;
        }

        .main-image-container {
            position: relative;
            aspect-ratio: 4/3;
            overflow: hidden;
            border-radius: 8px;
        }

        .main-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .main-image-container:hover img {
            transform: scale(1.02);
        }

        .thumbnail img {
            border-radius: 6px;
            transition: transform 0.2s ease;
        }

        .thumbnail:hover img {
            transform: scale(1.05);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .favorite-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
            background: white;
            border: 1px solid #ccc;
            padding: 6px 10px;
            border-radius: 50%;
            transition: all 0.2s ease;
        }

        .favorite-btn.active {
            background-color: #dc3545;
            color: white;
            border-color: #dc3545;
        }

        .favorite-btn i {
            font-size: 18px;
        }

        .thumb-wrapper {
            overflow-x: auto;
            scroll-behavior: smooth;
        }

        .thumb-wrapper::-webkit-scrollbar {
            display: none;
        }

        .thumb-nav {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endsection

@section(section: 'content')
    <div class="container py-5">
        <div class="row">
            {{-- Galería de imágenes --}}
            <div class="col-lg-8 position-relative">
                @php
                    $mainImage = $property->thumbnail ?? $property->image;
                @endphp

                <a href="{{ asset('storage/' . $mainImage) }}"
                    class="glightbox position-relative d-block overflow-hidden"
                    data-gallery="property-gallery" style="aspect-ratio: 4/3;">
                    <img id="mainImage" src="{{ asset('storage/' . $mainImage) }}" class="w-100 h-100 rounded"
                        style="object-fit: cover;" alt="{{ $property->title }}">
                </a>

                <button class="btn btn-light position-absolute top-0 end-0 m-2 rounded-circle shadow-sm favorite-btn">
                    <i class="bi bi-heart"></i>
                </button>

                <div class="mt-3 position-relative">
                    <button
                        class="thumb-nav prev btn btn-light shadow-sm rounded-circle position-absolute top-50 start-0 translate-middle-y z-3">
                        <i class="bi bi-chevron-left"></i>
                    </button>
                    <div class="thumb-wrapper overflow-hidden px-4">
                        <div class="thumb-row d-flex flex-nowrap gap-2">
                            @foreach ($property->images as $index => $img)
                                <div class="thumbnail" style="flex: 0 0 auto; width: 80px;">
                                    <a href="{{ asset("storage/{$img->path}") }}" class="glightbox"
                                        data-gallery="property-gallery">
                                        <img src="{{ asset("storage/{$img->path}") }}" class="w-100 border rounded"
                                            style="aspect-ratio: 1/1; object-fit: cover;"
                                            alt="{{ __('propertyShow.thumbnail') }} {{ $index + 1 }}">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button
                        class="thumb-nav next btn btn-light shadow-sm rounded-circle position-absolute top-50 end-0 translate-middle-y z-3">
                        <i class="bi bi-chevron-right"></i>
                    </button>
                </div>
            </div>

            {{-- Info rápida --}}
            <div class="col-lg-4">
                <div class="border rounded p-4 shadow-sm mb-4">
                    <h5 class="mb-2">{{ $property->title }}</h5>
                    <p class="text-muted small mb-1">
                        <i class="fas fa-map-marker-alt me-1"></i>{{ $property->zona->nombre }}
                    </p>
                    <p class="text-muted small mb-3">{{ __('propertyShow.ref') }}: <strong>{{ $property->ref }}</strong></p>
                    <h4 class="text-primary">
                        <i class="fas fa-euro-sign me-1"></i>{{ number_format($property->price, 0, ',', '.') }}
                    </h4>
                    <hr>
                    {{-- Iconitos --}}
                    <div class="d-flex flex-wrap gap-4 justify-content-between text-center small">
                        <div><i class="fas fa-home me-1"></i>{{ ucfirst($property->tipo ?? '-') }}</div>
                        <div><i class="fas fa-bed me-1"></i>{{ $property->bedrooms }} {{ __('propertyShow.bedrooms') }}</div>
                        <div><i class="fas fa-bath me-1"></i>{{ $property->bathrooms }} {{ __('propertyShow.bathrooms') }}</div>
                        <div><i class="fas fa-ruler-combined me-1"></i>{{ number_format($property->area / 100, 2, ',', '.') }} m²</div>
                        @if ($property->tiene_solar)
                            <div><i class="fas fa-border-none me-1"></i>{{ number_format($property->metros_solar / 100, 2, ',', '.') }} m² {{ __('propertyShow.solarium') }}</div>
                        @endif
                        @if ($property->tiene_patio)
                            <div><i class="fas fa-tree me-1"></i>{{ __('propertyShow.garden') }}</div>
                        @endif
                        @if ($property->tiene_piscina)
                            <div><i class="fas fa-water me-1"></i>{{ __('propertyShow.pool') }}</div>
                        @endif
                    </div>
                </div>

                {{-- Formulario --}}
                <div class="border rounded p-4 shadow-sm mb-4" id="formulario">
                    <h5 class="mb-4">{{ __('propertyShow.request_info') }}</h5>
                    <form action="#" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">{{ __('propertyShow.full_name') }} *</label>
                            <input type="text" name="name" class="form-control" placeholder="{{ __('propertyShow.example_name') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('propertyShow.email') }} *</label>
                            <input type="email" name="email" class="form-control" placeholder="{{ __('propertyShow.example_email') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">{{ __('propertyShow.phone') }} *</label>
                            <input type="tel" name="phone" class="form-control" placeholder="+34">
                        </div>
                        <button type="submit" class="btn btn-dark w-100 py-2 fs-5">
                            <i class="bi bi-send me-2"></i>{{ __('propertyShow.send_request') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Descripción --}}
        <div class="mt-5">
            <h5 class="fw-semibold">{{ __('propertyShow.description') }}</h5>
            @php
                $lang = app()->getLocale();
                $descKey = 'description_' . $lang;
                $description = $property->$descKey ?? $property->description;
            @endphp
            <p style="white-space: pre-line;">{{ $description }}</p>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const wrapper = document.querySelector('.thumb-wrapper');
            const prev = document.querySelector('.thumb-nav.prev');
            const next = document.querySelector('.thumb-nav.next');

            const scrollAmount = 100;

            prev.addEventListener('click', () => {
                wrapper.scrollBy({
                    left: -scrollAmount,
                    behavior: 'smooth'
                });
            });

            next.addEventListener('click', () => {
                wrapper.scrollBy({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            });
        });
    </script>
@endsection

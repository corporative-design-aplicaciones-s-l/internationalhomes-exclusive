@extends('layouts.guest')

@section('title', 'Entorno de la propiedad')

@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <style>
        .map-container {
            position: relative;
            width: 100%;
            /* max-width: 1500px; */
            margin: auto;
        }

        .map-image {
            width: 100%;
            height: auto;
            display: block;
        }

        .hotspot {
            position: absolute;
            width: 20px;
            height: 20px;
            background-color: rgba(255, 0, 0, 0.75);
            border: 1px solid black;
            border-radius: 50%;
            transform: translate(-50%, -50%);
            cursor: pointer;
            transition: transform 0.2s;
            z-index: 0;
        }

        .hotspot:hover {
            background-color: rgba(255, 238, 0, 0.75);
            transition: 0s;
        }

        .hotspot .label {
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(29, 29, 31, 0.85);
            color: white;
            padding: 4px 8px;
            font-size: 12px;
            border-radius: 4px;
            white-space: nowrap;
            z-index: 2;
            pointer-events: none;
            opacity: 1;
        }

        .label-top-left {
            top: auto;
            bottom: 28px;
            left: auto;
            right: 50%;
            transform: translateX(50%);
        }

        .label-bottom-right {
            top: 28px;
            left: 50%;
            transform: translateX(-50%);
        }

        .label-offset-left {
            top: -30px;
            left: 80%;
            transform: translateX(-50%);
        }

        .hotspot:hover .label {
            z-index: 5;
            display: none;
            transition: 0s;
        }

        .tooltip-card {
            position: absolute;
            backdrop-filter: blur(8px);
            background-color: rgba(255, 255, 255, 0.75);
            border: 1px solid rgba(255, 255, 255, 0.25);
            padding: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 220px;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            z-index: 100;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .tooltip-card.show {
            opacity: 1;
            animation: fadeIn 0.3s ease-out;
            visibility: visible;
            pointer-events: auto;
        }

        .tooltip-card img {
            width: 100%;
            border-radius: 4px;
            object-fit: cover;
            height: auto;
        }

        .tooltip-card h6 {
            margin: 10px 0 5px;
            font-size: 16px;
        }

        .tooltip-card a {
            text-decoration: none;
            color: #007bff;
        }

        .hero-slide::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.6), transparent 80%);
            z-index: 1;
        }

        /* Asegura que el contenido como el buscador esté encima del overlay */
        .hero-slide h1 {
            position: relative;
            z-index: 2;
        }

        @media (max-width: 768px) {

            .hotspot {
                width: 10px;
                height: 10px;

            }

            .hotspot .label {
                display: none;
            }
        }
    </style>

@endsection

@section('content')
    @php use Illuminate\Support\Str; @endphp

    <section class="swiper heroSwiper">
        <div class="swiper-wrapper">
            @foreach (['/images/environment-hero1.jpg', '/images/environment-hero2.jpg', '/images/environment-hero3.jpg'] as $img)
                <div class="swiper-slide position-relative hero-slide" style="height: 80vh;">
                    <div class="w-100 h-100" style="background: url('{{ $img }}') center center / cover no-repeat;">
                    </div>
                    <div
                        class="container h-100 d-flex align-items-center justify-content-center position-absolute top-0 start-0 end-0 bottom-0">
                        <div class="text-center text-white">
                            <h1 class="display-4 fw-light">@lang('environmentIndex.page_title')</h1>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="w-100 py-5 bg-light" data-aos="fade-up">
        <div class="container-fluid px-5">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('images/mapa_condado.svg') }}" alt="Mapa Condado de Alhama"
                        class="img-fluid rounded shadow-sm w-100">
                </div>
                <div class="col-md-6">
                    <h2 class="mb-4 fw-semibold">@lang('environmentIndex.section_title')</h2>
                    <p>@lang('environmentIndex.paragraph_1')</p>

                    <p>@lang('environmentIndex.paragraph_2')</p>

                    <p>@lang('environmentIndex.paragraph_3')</p>

                    {{-- Galería con Lightbox --}}
                    <div class="row mt-5 g-3 justify-content-center" data-aos="fade-up">
                        @foreach (['entorno1.jpg', 'entorno2.jpg', 'entorno3.jpg', 'entorno4.jpg', 'entorno5.png', 'entorno6.png', 'entorno7.jpg', 'entorno9.png'] as $i => $img)
                            <div class="col-6 col-md-3">
                                <a href="{{ asset("images/entorno/$img") }}"class="glightbox"
                                    data-gallery="entorno-gallery">
                                    <img src="{{ asset('images/entorno/' . $img) }}"
                                        class="img-fluid rounded shadow-sm w-100"
                                        style="object-fit: cover; aspect-ratio: 4/3;" alt="Entorno {{ $i + 1 }}">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>


        </div>
    </section>

    {{-- Ubicaciones --}}
    <section class="w-100 py-5 ">
        <div class="container-fluid px-5 text-center">
            <h2>@lang('environmentIndex.zones_title')</h2>
            <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center mt-4">

                @foreach ($zonas as $zona)
                    <div class="col">
                        <div class="card position-relative border-0 shadow-sm">
                            <img src="{{ asset('storage/' . $zona->imagen_principal) }}" class="card-img-top w-100"
                                style="height: 240px; object-fit: cover;" alt="{{ $zona->nombre }}">
                            <div class="card-img-overlay d-flex justify-content-center align-items-center">
                                <h4 class="text-white fw-semibold text-center"
                                    style="background-color: rgba(29, 29, 31, 0.65); padding: 12px 24px; border-radius: 12px; font-size: 1.25rem;">
                                    {{ $zona->nombre }}
                                </h4>
                            </div>
                            <a href="{{ route('zonas.show', ['locale' => app()->getLocale(), 'slug'=>$zona->slug]) }}" class="stretched-link"></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>

    <script>

        document.addEventListener('DOMContentLoaded', function() {
            new Swiper('.heroSwiper', {
                loop: true,
                effect: 'fade',
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                fadeEffect: {
                    crossFade: true,
                },
            });
        });
    </script>
@endsection

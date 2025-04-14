@extends('layouts.guest')

@section('title', 'Inicio')

@section('style')
    <link href="{{ asset(path: 'css/slider.css') }}" rel="stylesheet">
    <style>
        .hero-slide::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            /* Nivel de oscuridad */
            z-index: 1;
        }

        /* Asegura que el contenido como el buscador esté encima del overlay */
        .hero-slide>.container {
            position: relative;
            z-index: 2;
        }

        section.bg-dark {
            background: linear-gradient(to right, #2c3e50, #34495e);
        }
    </style>

@endsection

@section('content')
    {{-- Hero principal --}}
    <section class="swiper heroSwiper">
        <div class="swiper-wrapper">
            @foreach (['/images/hero1.jpg', '/images/hero2.jpg', '/images/hero3.jpg'] as $img)
                <div class="swiper-slide position-relative hero-slide" style="height: 80vh;">
                    <div class="w-100 h-100" style="background: url('{{ $img }}') center center / cover no-repeat;">
                    </div>
                    <div
                        class="container h-100 d-flex align-items-center justify-content-center position-absolute top-0 start-0 end-0 bottom-0">
                        <div class="text-center text-white">
                            <h1 class="display-4 fw-light">Descubre propiedades exclusivas</h1>
                            <p class="lead">En Condado de Alhama</p>

                            {{-- Buscador --}}
                            <form action="{{ route('search') }}" method="GET"
                                class="row g-2 mt-4 bg-white p-3 rounded shadow text-dark">
                                <div class="col-md-3">
                                    <select name="type" class="form-select">
                                        <option value="">Ubicación</option>
                                        <option value="piso">Residencial Oriol</option>
                                        <option value="casa">Villas Atenea</option>
                                        <option value="villa">Villa</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="type" class="form-select">
                                        <option value="">Tipo de propiedad</option>
                                        <option value="bugalow">Bungalow</option>
                                        <option value="apartment">Apartamento</option>
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
                </div>
            @endforeach
        </div>
    </section>

    {{-- Sección futura: propiedades destacadas --}}
    <section class="pt-5">
        <h2 class="mb-4 text-center">Propiedades destacadas</h2>

        <div class="container">
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($featured as $property)
                        <div class="swiper-slide">
                            <a href="{{ route('guest.property.show', $property->slug) }}" class="d-block position-relative"
                                style="aspect-ratio: 1/1; overflow: hidden;">
                                <img src="{{ 'storage/' . $property->thumbnail }}" class="w-100 h-100"
                                    style="object-fit: cover;" alt="{{ $property->title }}">
                                <div class="position-absolute bottom-0 start-0 end-0 p-2 text-white"
                                    style="background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);">
                                    <div class="fw-semibold small">{{ $property->title }}</div>
                                    <div class="small">{{ number_format($property->price, 0, ',', '.') }} €</div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>

                {{-- Controles --}}
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                {{-- <div class="swiper-pagination"></div> --}}
            </div>
        </div>
    </section>

    {{-- Golf --}}
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                {{-- Carrusel Swiper --}}
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="swiper golfSwiper">
                        <div class="swiper-wrapper">
                            @foreach (range(1, 4) as $i)
                                <div class="swiper-slide">
                                    <img src="{{ asset("images/golf/golf{$i}.jpg") }}"
                                        class="img-fluid rounded shadow w-100" alt="Golf imagen {{ $i }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <h2 class="fw-semibold">Campo de golf Alhama Signature</h2>
                    <p>
                        Diseñado por el legendario Jack Nicklaus, este campo de 18 hoyos par 72 es considerado uno de los
                        más
                        desafiantes y espectaculares de España. Integrado en un entorno natural único, ofrece vistas
                        impresionantes y una experiencia de golf de primera categoría.
                    </p>
                    <p>
                        Perfecto tanto para jugadores profesionales como amateurs, este campo eleva la calidad de vida de
                        quienes residen en el resort.
                    </p>
                </div>
            </div>
        </div>
    </section>



    <section class="py-5">
        <div class="container">
            <div class="row align-items-center flex-md-row-reverse">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="{{ asset('images/al-kasar.jpg') }}" class="img-fluid rounded shadow"
                        alt="Centro Comercial Al Kasar">
                </div>
                <div class="col-md-6">
                    <h2 class="fw-semibold">Centro comercial Al Kasar</h2>
                    <p>Con una arquitectura única, Al Kasar es el corazón comercial del resort. Aquí encontrarás
                        restaurantes, bares, supermercados, farmacia, tienda de golf, peluquería y más. Todo lo que
                        necesitas, a pocos pasos de tu vivienda.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row align-items-center">
                {{-- Carrusel Swiper --}}
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="swiper natSwiper">
                        <div class="swiper-wrapper">
                            @foreach (range(1, 4) as $i)
                                <div class="swiper-slide">
                                    <img src="{{ asset("images/naturaleza/nat{$i}.jpg") }}"
                                        class="img-fluid rounded shadow w-100" alt="Nature imagen {{ $i }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <h2 class="fw-semibold">Naturaleza, deporte y bienestar</h2>
                    <p>El resort está rodeado por parajes como la Sierra Espuña, Mazarrón y las playas de la Costa Cálida.
                        Un entorno ideal para practicar senderismo, ciclismo o simplemente relajarse. El clima mediterráneo
                        suave durante todo el año favorece una vida activa y saludable.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5 bg-dark text-white text-center">
        <div class="container">
            <h2 class="fw-light mb-3">¿Quieres saber más?</h2>
            <p class="mb-4 fs-5">Contacta con nosotros y descubre todo lo que Condado de Alhama puede ofrecerte.</p>
            <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg px-4 py-2">
                Contactar ahora
            </a>
        </div>
    </section>



    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                new Swiper(".heroSwiper", {
                    loop: true,
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                    effect: 'fade',
                    fadeEffect: {
                        crossFade: true
                    }
                });

                // ya estaba el otro Swiper:
                new Swiper(".mySwiper", {
                    slidesPerView: 4,
                    spaceBetween: 24,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    breakpoints: {
                        0: {
                            slidesPerView: 1.2
                        },
                        576: {
                            slidesPerView: 2
                        },
                        768: {
                            slidesPerView: 3
                        },
                        992: {
                            slidesPerView: 4
                        },
                    },
                });
            });

            document.addEventListener('DOMContentLoaded', function() {
                new Swiper('.golfSwiper', {
                    slidesPerView: 1,
                    spaceBetween: 10,
                    autoplay: {
                        delay: 2000,
                        disableOnInteraction: false,
                    },
                    loop: true,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                });
                new Swiper('.natSwiper', {
                    slidesPerView: 1,
                    spaceBetween: 10,
                    autoplay: {
                        delay: 2000,
                        disableOnInteraction: false,
                    },
                    loop: true,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                });
            });
        </script>
    @endpush

@endsection

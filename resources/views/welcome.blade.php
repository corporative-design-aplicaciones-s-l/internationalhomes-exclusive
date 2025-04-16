@extends('layouts.guest')

@section('title', 'Inicio')

@section('style')
    <link href="{{ asset(path: 'css/slider.css') }}" rel="stylesheet">
    <style>
        .hero-slide::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            z-index: 1;
        }

        .hero-slide>.container {
            position: relative;
            z-index: 2;
        }

        section.bg-dark {
            background: linear-gradient(to right, #2c3e50, #34495e);
        }

        .animate-hero {
            opacity: 0;
            transform: translateY(30px);
            transition: all 1s ease-out;
        }

        .hero-loaded .animate-hero {
            opacity: 1;
            transform: translateY(0);
        }

        .card:hover {
            transform: scale(1.01);
            transition: transform 0.3s ease;
        }

        .mySwiper .swiper-slide .bg-white {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .mySwiper .swiper-slide .bg-white:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        .mySwiper .swiper-slide img {
            transition: transform 0.4s ease;
        }

        .mySwiper .swiper-slide:hover img {
            transform: scale(1.03);
        }

        .fade-in-up {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }

        .fade-in-up.active {
            opacity: 1;
            transform: translateY(0);
        }


        @media (max-width: 768px) {

            .hero-slide form .form-control,
            .hero-slide form .form-select {
                font-size: 14px;
                padding: 0.4rem 0.6rem;
            }
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
                        <div class="text-center text-white animate-hero">
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
                                    <button type="submit" class="btn btn-dark w-100"><i
                                            class="fas fa-search me-2"></i><span class="d-none d-md-inline"> Buscar</button>
                                </div>
                            </form>
                            <a href="{{ route('contact') }}" class="btn btn-outline-light mt-3">
                                ¿Tienes dudas? Contáctanos
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Sección Viviendas Destacadas --}}
    <section class="py-5" style="background-color: #f7f7f7;" data-aos="fade-up">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <small class="text-uppercase text-muted">Propiedades destacadas</small>
                    <h2 class="fw-light mt-2">Propiedades para tu <strong>sueño mediterráneo</strong></h2>
                </div>
                <a href="{{ route('guest.properties.index') }}"
                    class="text-decoration-none text-dark fw-semibold text-uppercase small">
                    Ver todas las propiedades <i class="fas fa-chevron-right ms-1"></i>
                </a>
            </div>

            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    @foreach ($featured as $property)
                        <div class="swiper-slide fade-in-up">
                            <div class="bg-white rounded-4 shadow-sm overflow-hidden position-relative p-3">
                                {{-- Imagen --}}
                                <a href="{{ route('guest.property.show', $property->slug) }}">
                                    <img src="{{ asset('storage/' . $property->thumbnail) }}" class="w-100 rounded-3 mb-3"
                                        style="aspect-ratio: 4/3; object-fit: cover;" alt="{{ $property->title }}">
                                </a>

                                {{-- Badges --}}
                                <div class="mb-2 d-flex gap-2">
                                    <span class="badge bg-warning text-bg-dark text-uppercase small">Exclusiva</span>
                                    @if ($property->vista_al_mar)
                                        <span class="badge bg-primary text-white text-uppercase small">Vista al mar</span>
                                    @endif
                                </div>

                                {{-- Iconitos con datos --}}
                                <div class="d-flex justify-content-between text-muted small mb-3 text-center">
                                    <div><i class="fas fa-ruler-combined d-block mb-1"></i>{{ $property->area ?? '-' }} m²
                                    </div>
                                    <div><i class="fas fa-expand d-block mb-1"></i>{{ $property->metros_solar ?? '-' }} m²
                                    </div>
                                    <div><i class="fas fa-bed d-block mb-1"></i>{{ $property->bedrooms ?? '-' }}</div>
                                    <div><i class="fas fa-bath d-block mb-1"></i>{{ $property->bathrooms ?? '-' }}</div>
                                    <div><i class="fas fa-warehouse d-block mb-1"></i>{{ $property->tipo ?? '-' }}</div>
                                </div>

                                {{-- Título tipo LA ZENIA --}}
                                <h6 class="fw-bold text-uppercase mb-0 text-black">
                                    {{ Str::upper(Str::limit($property->zona->nombre, 20)) }}
                                    <div class="text-muted text-capitalize fw-normal">Condado de Alhama</div>
                                </h6>

                                <small class="text-uppercase text-muted">{{ ucfirst($property->tipo) }} · Obra
                                    nueva</small>

                                {{-- Ref y precio --}}
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="badge bg-black text-white text-uppercase">Ref:
                                        {{ $property->ref }}</span>
                                    <strong class="text-dark fs-5">{{ number_format($property->price, 0, ',', '.') }}
                                        €</strong>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Controles --}}
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </section>




    <section class="py-5" style="background: linear-gradient(to top, #fff 50%, #f8f8f8 50%);" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center">
                {{-- Imágenes lado izquierdo en fila vertical --}}
                <div class="col-md-6 d-flex justify-content-center align-items-end gap-3">
                    <img src="{{ asset('images/golf/golf1.jpg') }}" class=" shadow-sm"
                        style="height: 330px; width: auto; object-fit: cover;" alt="Golf 1">

                    <img src="{{ asset('images/golf/golf2.jpg') }}" class=" shadow-sm"
                        style="height: 400px; width: auto; object-fit: cover; margin-bottom: 40px;" alt="Golf 2">
                </div>

                <div class="col-md-6 ps-md-5">
                    {{-- Caja con efecto cristal --}}
                    <div
                        style="backdrop-filter: blur(8px); background-color: rgba(255, 255, 255, 0.45); border-radius: 16px; padding: 32px;">
                        <small class="text-uppercase text-muted fw-semibold">Golf & Naturaleza</small>
                        <h2 class="fw-semibold mt-2 mb-3">Campo de golf Alhama Signature</h2>
                        <p>Diseñado por el legendario Jack Nicklaus, este campo de 18 hoyos par 72 es considerado uno de los
                            más desafiantes y espectaculares de España.</p>
                        <p>Integrado en un entorno natural único, ofrece vistas impresionantes y una experiencia de golf de
                            primera categoría. Perfecto tanto para jugadores profesionales como amateurs, este campo eleva
                            la calidad de vida de quienes residen en el resort.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    {{-- Centro Comercial Al-Kasar --}}
    <section class="py-5 bg-white" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center flex-md-row-reverse">
                <div class="col-md-6 position-relative mb-4 mb-md-0">
                    {{-- Imagen principal --}}
                    <img src="{{ asset('images/al-kasar.jpg') }}" class="img-fluid rounded shadow w-100" alt="Al Kasar">

                    {{-- Mini imagen flotante --}}
                    <img src="{{ asset('images/al-kasar2.jpg') }}"
                        class="position-absolute rounded shadow d-none d-md-block"
                        style="width: 45%; bottom: -20px; left: -20px; border: 4px solid #fff;" alt="Al Kasar mini">
                </div>

                <div class="col-md-6">
                    <small class="text-uppercase text-muted fw-semibold">Servicios & Ocio</small>
                    <h2 class="fw-semibold mt-2 mb-3">Centro comercial Al Kasar</h2>
                    <p class="fs-5">
                        Con una arquitectura única, Al Kasar es el <strong>corazón comercial del resort</strong>. Aquí
                        encontrarás restaurantes, bares, supermercados, farmacia, tienda de golf, peluquería y más.
                    </p>
                    <p class="fs-5">
                        Todo lo que necesitas está a pocos pasos de tu vivienda, en un entorno cuidado y seguro que ofrece
                        <strong>comodidad y calidad de vida</strong> para todos los residentes.
                    </p>
                </div>
            </div>
        </div>
    </section>


    {{-- Naturaleza --}}
    <section class="py-5 bg-light" data-aos="fade-up">
        <div class="container">
            <div class="row align-items-center">
                {{-- Mosaico imágenes --}}
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="row g-2">
                        <div class="col-6">
                            <img src="{{ asset('images/naturaleza/nat1.jpg') }}" class="img-fluid rounded shadow w-100"
                                alt="Naturaleza">
                        </div>
                        <div class="col-6">
                            <img src="{{ asset('images/naturaleza/nat2.jpg') }}" class="img-fluid rounded shadow w-100"
                                alt="Naturaleza">
                        </div>
                        <div class="col-12">
                            <div class="overflow-hidden rounded shadow" style="max-height: 300px;">
                                <img src="{{ asset('images/naturaleza/nat3.jpg') }}" class="img-fluid w-100"
                                    style="object-fit: cover; height: 100%;" alt="Naturaleza">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Texto --}}
                <div class="col-md-6">
                    <h2 class="fw-semibold">Naturaleza, deporte y bienestar</h2>
                    <p class="fs-5">
                        El resort está rodeado por parajes como la <strong>Sierra Espuña</strong>, <strong>Mazarrón</strong>
                        y las playas de la <strong>Costa Cálida</strong>.
                    </p>
                    <p class="fs-5">
                        Un entorno ideal para practicar senderismo, ciclismo o simplemente relajarse. El clima mediterráneo
                        suave durante todo el año favorece una vida activa y saludable.
                    </p>
                </div>
            </div>
        </div>
    </section>


    {{-- CTA final --}}
    <section class="py-5 bg-dark text-white text-center" data-aos="fade-up">
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

            document.addEventListener("DOMContentLoaded", function() {
                setTimeout(() => {
                    document.querySelector(".heroSwiper").classList.add("hero-loaded");
                }, 400);
            });

            document.addEventListener('DOMContentLoaded', function() {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('active');
                        }
                    });
                }, {
                    threshold: 0.1
                });

                document.querySelectorAll('.fade-in-up').forEach(el => {
                    observer.observe(el);
                });
            });
        </script>
    @endpush

@endsection

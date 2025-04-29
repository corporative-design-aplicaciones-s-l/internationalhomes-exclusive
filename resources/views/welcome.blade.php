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
    @include('partials.home.hero')
    <section class="w-100 py-5 bg-light data-aos="fade-up"">
        <div class="container-fluid px-2 text-center">

            <h2>MASTER PLAN</h2>
            {{-- Mapa interactivo --}}
            <div class="map-container position-relative" id="mapContainer">
                <img src="{{ asset('images/map/MASTER-PLAN-BASE-GENERAL.png') }}" alt="Mapa Interactivo" class="map-image">

                <!-- Hotspots con tooltip -->
                <div class="hotspot" style="top: 28.5%; left: 75%;" data-name="Alhama Arena"
                    data-image="/images/map/alhamaarena.jpg" data-link="" data-aos="fade-down" data-aos-duration="1000"
                    data-aos-delay="500" data-aos-once="true">
                    <span class="label">Alhama Arena</span>
                </div>

                <div class="hotspot" style="top: 35%; left: 68%;" data-name="Practise Area"
                    data-image="/images/map/practise.jpg" data-link="" data-aos="fade-down" data-aos-duration="1000"
                    data-aos-delay="600" data-aos-once="true">
                    <span class="label">Practise Area</span>
                </div>

                <div class="hotspot" style="top: 40.5%; left: 66.2%;" data-name="Actual Clubhouse"
                    data-image="/images/map/actualclubhouse.jpg" data-link="" data-aos="fade-down"
                    data-aos-duration="1000" data-aos-delay="700" data-aos-once="true">
                    <span class="label">Actual Clubhouse</span>
                </div>

                <div class="hotspot" style="top: 42%; left: 64.5%;" data-name="New Clubhouse"
                    data-image="/images/map/newclubhouse.jpg" data-link="" data-aos="fade-down" data-aos-duration="1000"
                    data-aos-delay="800" data-aos-once="true">
                    <span class="label" style="top: -3px; left: -55px;">New Clubhouse</span>
                </div>

                <div class="hotspot" style="top: 44%; left: 66.2%;" data-name="New Shopping Mall"
                    data-image="/images/map/newshopin.jpg" data-link="" data-aos="fade-down" data-aos-duration="1000"
                    data-aos-delay="900" data-aos-once="true">
                    <span class="label" style="top: -3px; left: 65px;">Shopping Mall</span>
                </div>

                <div class="hotspot" style="top: 48%; left: 69.5%;" data-name="New Hotel"
                    data-image="/images/map/newhotel.jpg" data-link="" data-aos="fade-down" data-aos-duration="1000"
                    data-aos-delay="1000" data-aos-once="true">
                    <span class="label" style="top: -3px; left: 45px;">Hotel</span>
                </div>

                <div class="hotspot" style="top: 62.5%; left: 45%;" data-name="Sales Office"
                    data-image="/images/map/salesoffice.jpg" data-link="" data-aos="fade-down" data-aos-duration="1000"
                    data-aos-delay="1100" data-aos-once="true">
                    <span class="label">Sales Office</span>
                </div>

                <div class="hotspot" style="top: 68%; left: 63%;" data-name="Oriol Villas"
                    data-image="/images/map/oriol.jpg" data-link="https://internationalhomes-exclusive.com/es/entorno/residencial-oriol" data-aos="fade-down" data-aos-duration="1000"
                    data-aos-delay="1200" data-aos-once="true">
                    <span class="label">Oriol Villas</span>
                </div>

                <div class="hotspot" style="top: 75.4%; left: 56.2%;" data-name="Main Entrance"
                    data-image="/images/map/mainentrance.jpg" data-link="" data-aos="fade-down" data-aos-duration="1000"
                    data-aos-delay="1300" data-aos-once="true">
                    <span class="label">Entrada Principal</span>
                </div>

                <div class="hotspot" style="top: 69%; left: 46.8%;" data-name="Al Kasar"
                    data-image="/images/map/alkasar.jpg" data-link="" data-aos="fade-down" data-aos-duration="1000"
                    data-aos-delay="1400" data-aos-once="true">
                    <span class="label">Al Kasar</span>
                </div>

                <div class="hotspot" style="top: 73%; left: 40.8%;" data-name="Villas Atenea"
                    data-image="/images/map/atenea.jpg" data-link="https://internationalhomes-exclusive.com/es/subzona/villas-atenea" data-aos="fade-down" data-aos-duration="1000"
                    data-aos-delay="1500" data-aos-once="true">
                    <span class="label" style="top: -3px; left: 65px;">Villas Atenea</span>
                </div>

                <div class="hotspot" style="top: 73%; left: 34.8%;" data-name="Bungalows Gaudí"
                    data-image="/images/map/bungagaudi.jpg" data-link="https://internationalhomes-exclusive.com/es/subzona/bungalows-gaudi" data-aos="fade-down" data-aos-duration="1000"
                    data-aos-delay="1600" data-aos-once="true">
                    <span class="label" style="top: 30px;">Bungalows Gaudí</span>
                </div>

                <div class="hotspot" style="top: 69%; left: 34.8%;" data-name="Bungalows Premium"
                    data-image="/images/map/bungapremium.jpg" data-link="https://internationalhomes-exclusive.com/es/subzona/bungalows-gaudi" data-aos="fade-down"
                    data-aos-duration="1000" data-aos-delay="1700" data-aos-once="true">
                    <span class="label">Bungalows Premium</span>
                </div>

                <div class="hotspot" style="top: 71%; left: 30.8%;" data-name="Apartments"
                    data-image="/images/map/apartments.jpg" data-link="https://internationalhomes-exclusive.com/es/subzona/apartamentos-azahar" data-aos="fade-down" data-aos-duration="1000"
                    data-aos-delay="1800" data-aos-once="true">
                    <span class="label" style="top: -3px; left: -55px;">Apartamentos</span>
                </div>

                <div class="hotspot" style="top: 60.3%; left: 26.4%;" data-name="Nostrum Living Care"
                    data-image="/images/map/nostrumlive.jpg" data-link="" data-aos="fade-down"
                    data-aos-duration="1000" data-aos-delay="1900" data-aos-once="true">
                    <span class="label">Nostrum Care</span>
                </div>

                <div class="hotspot" style="top: 38.6%; left: 25.8%;" data-name="Sports Area & Restaurant"
                    data-image="/images/map/sports.jpg" data-link="" data-aos="fade-down" data-aos-duration="1000"
                    data-aos-delay="2000" data-aos-once="true">
                    <span class="label">Deportes y Restaurante</span>
                </div>



                <!-- Tarjeta tooltip -->
                <div class="tooltip-card" id="tooltip-card"></div>

            </div>
        </div>
    </section>
    @include('partials.home.featured')
    @include('partials.home.golf')
    @include('partials.home.kasar')
    @include('partials.home.nature')
    @include('partials.home.cta')


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
            document.addEventListener('DOMContentLoaded', function() {
                const tooltip = document.getElementById('tooltip-card');
                const map = document.getElementById('mapContainer');
                let hideTimeout;

                document.querySelectorAll('.hotspot').forEach(hotspot => {
                    hotspot.addEventListener('mouseenter', (e) => {
                        clearTimeout(hideTimeout);

                        const name = hotspot.dataset.name;
                        const image = hotspot.dataset.image;
                        const link = hotspot.dataset.link;

                        tooltip.innerHTML = `
                        <img src="${image}" alt="${name}" >
                        <h6>${name}</h6>
                        ${link ? `<a href="${link}" target="_blank" >Ver más</a>` : ''}
                    `;

                        AOS.refresh();
                        tooltip.style.display = 'block';
                        tooltip.classList.add('show');
                    });

                    hotspot.addEventListener('mousemove', (e) => {
                        const containerRect = map.getBoundingClientRect();
                        const left = e.clientX - containerRect.left - 110;
                        const top = e.clientY - containerRect.top - 280;

                        tooltip.style.left = `${left}px`;
                        tooltip.style.top = `${top}px`;
                    });

                    hotspot.addEventListener('mouseleave', () => {
                        hideTimeout = setTimeout(() => {
                            tooltip.classList.remove('show');
                            tooltip.style.display = 'none';
                        }, 500);
                    });
                });

                tooltip.addEventListener('mouseenter', () => {
                    clearTimeout(hideTimeout);
                });

                tooltip.addEventListener('mouseleave', () => {
                    hideTimeout = setTimeout(() => {
                        tooltip.classList.remove('show');
                        tooltip.style.display = 'none';
                    }, 100);
                });
            });
        </script>
    @endpush

@endsection

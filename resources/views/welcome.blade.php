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
    @include('partials.home.hero')
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
        </script>
    @endpush

@endsection

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'International-homes')</title>
    <link href="https://fonts.googleapis.com/css2?family=Titillium+Web:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/glightbox.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    @vite(entrypoints: ['resources/css/app.css', 'resources/js/app.js', 'resources/js/swiper.js'])
    @yield('style', '')

    <style>
        body {
            font-family: 'Titillium Web', sans-serif;
            background-color: #fff;
            color: #222;
        }

        h1,
        h2,
        h3 {
            font-weight: 300;
        }

        a {
            text-decoration: none;
        }

        .nav-link {
            position: relative;
            transition: color 0.3s ease, transform 0.2s ease;
            color: #333;
        }

        .nav-link:hover {
            color: #000;
            transform: scale(1.05);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -4px;
            width: 0;
            height: 2px;
            background-color: #000;
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .navbar.scrolled {
            background-color: #fff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .transition-navbar {
            transition: all 0.3s ease;
        }

        .transition-navbar.scrolled {
            padding-top: 0.5rem !important;
            padding-bottom: 0.5rem !important;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .transition-navbar.scrolled img {
            height: 36px !important;
            transition: height 0.3s ease;
        }
    </style>
</head>

<body>
    @include('layouts.navigation')

    <main class="pb-0">
        @yield('content')
        @yield('slider')
    </main>

    <footer class="bg-dark text-white position-relative overflow-hidden">
        <div class="position-absolute top-0 start-0 w-100" style="z-index: 1;">
            <svg viewBox="0 0 1440 120" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path fill="#1a1a1a" d="M0,64L1440,0L1440,120L0,120Z"></path>
            </svg>
        </div>

        <div class="position-absolute top-0 start-0 w-100 h-100"
            style="background: url('{{ asset('images/footer-bg.jpg') }}') center center / cover no-repeat; opacity: 0.15; z-index: 0;">
        </div>

        <div class="container position-relative" style="z-index: 2;">
            <div class="row text-center text-md-start py-5">
                <div class="col-md-4 mb-4">
                    <img src="{{ asset('images/logo/logo-gris.svg') }}" alt="Logo" style="height: 80px;">
                </div>

                <div class="col-md-4 mb-4">
                    <h6 class="text-uppercase small fw-bold mb-3">{{ __('menu.menu') }}</h6>
                    <ul class="list-unstyled small">
                        <li><a href="{{ url('/') }}" class="text-white text-decoration-none">{{ __('menu.home') }}</a></li>
                        <li><a href="{{ route('guest.properties.index', ['locale' => app()->getLocale()]) }}" class="text-white text-decoration-none">{{ __('menu.properties') }}</a></li>
                        <li><a href="{{ route('environment', ['locale' => app()->getLocale()]) }}" class="text-white text-decoration-none">{{ __('menu.environment') }}</a></li>
                        <li><a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" class="text-white text-decoration-none">{{ __('menu.contact') }}</a></li>
                    </ul>
                </div>

                <div class="col-md-4 mb-4">
                    <h6 class="text-uppercase small fw-bold mb-3">{{ __('menu.contact') }}</h6>
                    <p class="small mb-2"><i class="fas fa-envelope me-2"></i>info@internationalhomes.com</p>
                    <p class="small mb-2"><i class="fas fa-phone me-2"></i>+34 600 123 456</p>
                    <p class="small"><i class="fas fa-map-marker-alt me-2"></i>Condado de Alhama, Murcia</p>
                </div>
            </div>

            <div class="pt-4 border-top border-secondary text-center">
                <h6 class="text-uppercase small mb-3 mt-4 text-white-50">{{ __('menu.top_searches') }}</h6>
                <div class="row justify-content-center text-white small">
                    <div class="col-6 col-md-3 mb-2"><a href="#" class="text-white-50 text-decoration-none">Costa Cálida</a></div>
                    <div class="col-6 col-md-3 mb-2"><a href="#" class="text-white-50 text-decoration-none">Apartamentos en Oriol</a></div>
                    <div class="col-6 col-md-3 mb-2"><a href="#" class="text-white-50 text-decoration-none">Villas con piscina</a></div>
                    <div class="col-6 col-md-3 mb-2"><a href="#" class="text-white-50 text-decoration-none">Bungalows modernos</a></div>
                </div>
            </div>
        </div>

        <hr class="border-secondary">

        <div class="row text-center small text-muted py-2">
            <div class="col-md-6 text-light">
                © {{ date('Y') }} International Homes. {{ __('menu.rights') }}
            </div>
            <div class="col-md-6">
                <a href="#" class="text-light text-decoration-none me-2">{{ __('menu.footer_legal') }}</a>
                <a href="#" class="text-light text-decoration-none me-2">{{ __('menu.footer_privacy') }}</a>
                <a href="#" class="text-light text-decoration-none me-2">{{ __('menu.footer_cookies') }}</a>
                <a href="#" class="text-light text-decoration-none">{{ __('menu.footer_sitemap') }}</a>
            </div>
        </div>
    </footer>

    @stack('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const lightbox = GLightbox({ selector: '.glightbox' });

            const navbar = document.querySelector('.transition-navbar');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });
        });

        AOS.init();
    </script>

    @yield('scripts')
</body>

</html>

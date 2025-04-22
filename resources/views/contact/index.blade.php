@extends('layouts.guest')

@section('title', 'Contáctanos')

@section('style')
    <style>
        .contact-hero {
            background: url('/images/contact-hero.jpg') no-repeat center center;
            background-size: cover;
            height: 60vh;
            position: relative;
        }

        .contact-hero::after {
            content: '';
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.55);
        }

        .contact-hero h1 {
            position: relative;
            z-index: 2;
        }

        .contact-section {
            padding: 60px 0;
        }

        .contact-info-icon {
            font-size: 1.75rem;
            color: var(--bs-dark);
            margin-right: 1rem;
        }

        .contact-card {
            background-color: #f9f9f9;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .btn-main {
            background-color: #000;
            color: #fff;
            border: none;
        }

        .btn-main:hover {
            background-color: #333;
        }

        #map {
            height: 400px;
            width: 100%;
            border-radius: 12px;
            margin-top: 60px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('content')

    {{-- Hero --}}
    <section class="contact-hero d-flex align-items-center justify-content-center text-center text-white">
        <h1 class="display-4 fw-light" data-aos="fade-down">Contáctanos</h1>
    </section>

    {{-- Contenido principal --}}
    <section class="contact-section bg-light">
        <div class="container">
            <div class="row g-5">
                {{-- Columna izquierda --}}
                <div class="col-lg-5" data-aos="fade-right">
                    <h2 class="mb-4">¿Hablamos?</h2>
                    <p class="mb-4 text-muted">Puedes llamarnos, enviarnos un email o visitarnos. Estaremos encantados de
                        ayudarte.</p>

                    <div class="contact-info">
                        <div class="d-flex align-items-start mb-4">
                            <i class="bi bi-telephone contact-info-icon"></i>
                            <div>
                                <p class="fw-semibold">Teléfono</p>
                                <p class="text-muted">+34 600 000 000</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start mb-4">
                            <i class="bi bi-envelope contact-info-icon"></i>
                            <div>
                                <p class="fw-semibold">Email</p>
                                <p class="text-muted">info@tudominio.com</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-start">
                            <i class="bi bi-geo-alt contact-info-icon"></i>
                            <div>
                                <p class="fw-semibold">Dirección</p>
                                <p class="text-muted">Av. Principal 123, Murcia</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Formulario --}}
                <div class="col-lg-7" data-aos="fade-left">
                    <div class="contact-card">
                        <h4 class="mb-4">Envíanos tu mensaje</h4>
                        <form action="{{ route('contact.store', ['locale' => app()->getLocale()]) }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre *</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico *</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Mensaje *</label>
                                <textarea name="message" rows="4" class="form-control" required></textarea>
                            </div>

                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="accept_terms" required>
                                <label class="form-check-label" for="accept_terms">
                                    Acepto los <a href="#">términos y condiciones</a>
                                </label>
                            </div>

                            <button type="submit" class="btn btn-main w-100 py-2 fs-5">
                                <i class="bi bi-send me-2"></i>Enviar mensaje
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Mapa --}}
            <div id="map" class="mt-5" data-aos="fade-up"></div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        AOS.init();

        // Iniciar Leaflet con coordenadas aproximadas
        const map = L.map('map').setView([37.73540415377019, -1.3592778545976794], 14);
        L.Icon.Default.mergeOptions({
            iconRetinaUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon-2x.png',
            iconUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-icon.png',
            shadowUrl: 'https://unpkg.com/leaflet@1.9.4/dist/images/marker-shadow.png',
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([37.73540415377019, -1.3592778545976794]).addTo(map)
            // .bindPopup("<b>Oficina principal</b><br>Av. Principal 123, Murcia")
            // .openPopup();
    </script>
@endsection

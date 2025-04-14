@extends('layouts.guest')

@section('title', 'Entorno de la propiedad')

@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">
    <style>
        .map-container {
            position: relative;
            width: 100%;
            max-width: 1200px;
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
            border-radius: 50%;
            transform: translate(-50%, -50%);
            cursor: pointer;
            transition: transform 0.2s;
            z-index: 0;
        }

        .hotspot:hover {
            width: 25px;
            height: 25px;
            background-color: rgba(255, 230, 0, 0.75);
            transition: 0.3s;
        }

        .hotspot .label {
            position: absolute;
            top: -25px;
            /* separa el texto por encima */
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 3px 6px;
            font-size: 12px;
            border-radius: 4px;
            white-space: nowrap;
            pointer-events: none;
            display: none;

        }

        .hotspot:hover .label {
            z-index: 5;
            display: block;
        }

        .tooltip-card {
            position: absolute;
            background-color: white;
            border-radius: 8px;
            padding: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            width: 220px;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            z-index: 100;
        }

        .tooltip-card.show {
            opacity: 1;
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
            background: rgba(0, 0, 0, 0.5);
            /* Nivel de oscuridad */
            z-index: 1;
        }

        /* Asegura que el contenido como el buscador esté encima del overlay */
        .hero-slide>.container {
            position: relative;
            z-index: 2;
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
                            <h1 class="display-4 fw-light">Conoce el entorno</h1>
                        </div>
                    </div>
            @endforeach
        </div>
    </section>

    <section class="w-100 py-5 bg-light">
        <div class="container-fluid px-5">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="{{ asset('images/mapa_condado.svg') }}" alt="Mapa Condado de Alhama"
                        class="img-fluid rounded shadow-sm w-100">
                </div>
                <div class="col-md-6">
                    <h2 class="mb-4 fw-semibold">Condado de Alhama</h2>
                    <p>
                        Ubicado en el corazón de la <strong>Costa Cálida murciana</strong>, el Condado de Alhama Golf Resort
                        combina naturaleza, deporte y comodidad. Con vistas a la <strong>Sierra Espuña</strong> y a tan solo
                        minutos de <strong>Cartagena</strong>, <strong>Mazarrón</strong> y <strong>Murcia capital</strong>,
                        es un enclave privilegiado.
                    </p>
                    <p>
                        Aquí disfrutarás de un entorno seguro y tranquilo, con propiedades modernas como
                        <strong>apartamentos, villas y bungalows</strong>, diseñados para vivir todo el año o pasar largas
                        temporadas. Terrazas, soláriums, jardines y piscinas hacen del resort un lugar ideal para el
                        bienestar.
                    </p>
                    <p>
                        Además del entorno natural, destaca el <strong>campo de golf Alhama Signature</strong>, diseñado por
                        Jack Nicklaus, y servicios como el centro comercial <strong>Al Kasar</strong>, supermercados, zonas
                        deportivas y restaurantes. Todo lo que necesitas, en un lugar que apuesta por el crecimiento y la
                        calidad de vida.
                    </p>
                    {{-- Galería con Lightbox --}}
                    <div class="row mt-5 g-3 justify-content-center">
                        @foreach (['entorno1.jpg', 'entorno2.jpg', 'entorno3.jpg', 'entorno4.jpg', 'entorno5.png', 'entorno6.png', 'entorno7.jpg', 'entorno9.png'] as $i => $img)
                            <div class="col-6 col-md-3">
                                <a href="{{ asset('images/entorno/' . $img) }}"class="glightbox"
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
    <section class="w-100 py-5 bg-light">
        <div class="container-fluid px-5 text-center">

            <h2>Mapa Interactivo</h2>
            {{-- Mapa interactivo --}}
            <div class="map-container position-relative" id="mapContainer"
                style="width: 100%; max-width: 1200px; margin: auto;">
                <img src="{{ asset('images/map/MASTER-PLAN-BASE-GENERAL.png') }}" alt="Mapa Interactivo" class="map-image">

                <!-- Hotspots con tooltip -->
                <div class="hotspot" style="top: 28.5%; left: 75%;" data-name="Alhama Arena"
                    data-image="/images/map/alhamaarena.jpg" data-link=""></div>

                <div class="hotspot" style="top: 35%; left: 68%;" data-name="Practise Area"
                    data-image="/images/map/practise.jpg" data-link=""></div>


                <div class="hotspot" style="top: 40.5%; left: 66.2%;" data-name="Actual Clubhouse"
                    data-image="/images/map/actualclubhouse.jpg" data-link=""></div>

                <div class="hotspot" style="top: 42%; left: 64.5%;" data-name="New Clubhouse"
                    data-image="/images/map/newclubhouse.jpg" data-link=""></div>

                <div class="hotspot" style="top: 44%; left: 66.2%;" data-name="New Shopping Mall"
                    data-image="/images/map/newshopin.jpg" data-link=""></div>

                <div class="hotspot" style="top: 48%; left: 69.5%;" data-name="New Hotel"
                    data-image="/images/map/newhotel.jpg" data-link=""></div>

                <div class="hotspot" style="top: 62.5%; left: 45%;" data-name="Alhama Nature Sales Office"
                    data-image="/images/map/salesoffice.jpg" data-link=""></div>

                <div class="hotspot" style="top: 68%; left: 63%;" data-name="Oriol Villas"
                    data-image="/images/map/oriol.jpg" data-link=""></div>

                <div class="hotspot" style="top: 75.4%; left: 56.2%;" data-name="Main Entrance"
                    data-image="/images/map/mainentrance.jpg" data-link=""></div>

                <div class="hotspot" style="top: 69%; left: 46.8%;" data-name="Al Kasar Shopping Mall"
                    data-image="/images/map/alkasar.jpg" data-link=""></div>

                <div class="hotspot" style="top: 73%; left: 40.8%;" data-name="Villas Atenea"
                    data-image="/images/map/atenea.jpg" data-link=""></div>

                <div class="hotspot" style="top: 73%; left: 34.8%;" data-name="Bungalows Gaudí"
                    data-image="/images/map/bungagaudi.jpg" data-link=""></div>

                <div class="hotspot" style="top: 69%; left: 34.8%;" data-name="Bungalows Premium"
                    data-image="/images/map/bungapremium.jpg" data-link=""></div>

                <div class="hotspot" style="top: 71%; left: 30.8%;" data-name="Apartments"
                    data-image="/images/map/apartments.jpg" data-link=""></div>

                <div class="hotspot" style="top: 60.3%; left: 26.4%;" data-name="Nostrum Living Care"
                    data-image="/images/map/nostrumlive.jpg" data-link=""></div>

                <div class="hotspot" style="top: 38.6%; left: 25.8%;" data-name="Sports Area & Restaurant"
                    data-image="/images/map/sports.jpg" data-link=""></div>

                <!-- Tarjeta tooltip -->
                <div class="tooltip-card" id="tooltip-card"></div>

            </div>
        </div>
    </section>

    {{-- Ubicaciones --}}
    <section class="w-100 py-5 ">
        <div class="container-fluid px-5 text-center">
            <h2>Las zonas</h2>
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
                            <a href="{{ route('zonas.show', ['slug' => $zona->slug]) }}" class="stretched-link"></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@section('scripts')

    <script>
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
                        <img src="${image}" alt="${name}">
                        <h6>${name}</h6>
                        ${link ? `<a href="${link}" target="_blank">Ver más</a>` : ''}
                    `;
                    tooltip.style.display = 'block';
                    tooltip.classList.add('show');
                });

                hotspot.addEventListener('mousemove', (e) => {
                    const containerRect = map.getBoundingClientRect();
                    const left = e.clientX - containerRect.left + 15;
                    const top = e.clientY - containerRect.top - 10;

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
    </script>
@endsection

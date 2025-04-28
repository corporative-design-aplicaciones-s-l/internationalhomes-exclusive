@extends('layouts.guest')

@section('title', $subzona->nombre)

@section('style')
    <link href="{{ asset('css/lightbox.css') }}" rel="stylesheet">
@endsection

@section('content')
<section class="bg-dark text-white py-5" style="background-image: url('{{ asset('storage/' . $subzona->imagen_destacada) }}'); background-size: cover; background-position: center;">
    <div class="container py-5 text-shadow">
        <h1 class="display-5 fw-bold">{{ $subzona->nombre }}</h1>
        @if($subzona->resumen)
            <p class="lead mt-3">{{ $subzona->resumen }}</p>
        @endif
        <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" class="btn btn-light btn-lg mt-3">
            <i class="bi bi-envelope me-2"></i> Solicitar información
        </a>
    </div>
</section>

<section class="py-5">
    <div class="container">

        {{-- Características destacadas --}}
        <div class="row mb-5">
            <div class="col-md-6">
                <table class="table table-bordered">
                    <tbody>
                        @if($subzona->superficie)<tr><th>Superficie</th><td>{{ $subzona->superficie }} m²</td></tr>@endif
                        @if($subzona->habitaciones)<tr><th>Habitaciones</th><td>{{ $subzona->habitaciones }}</td></tr>@endif
                        @if($subzona->banos)<tr><th>Baños</th><td>{{ $subzona->banos }}</td></tr>@endif
                        @if($subzona->precio_desde)<tr><th>Desde</th><td>€{{ number_format($subzona->precio_desde, 0, ',', '.') }}</td></tr>@endif
                        @if($subzona->estado)<tr><th>Estado</th><td>{{ $subzona->estado }}</td></tr>@endif
                    </tbody>
                </table>
            </div>

            <div class="col-md-6">
                {{-- PDFs --}}
                <div class="mb-3">
                    @if($subzona->pdf_info_comercial)
                    <a href="{{ asset('storage/' . $subzona->pdf_info_comercial) }}" target="_blank" class="btn btn-outline-dark w-100 mb-2">
                        <i class="bi bi-file-earmark-text me-2"></i> Descargar Información Comercial
                    </a>
                @endif
                @if($subzona->plano)
                    <a href="{{ asset('storage/' . $subzona->plano) }}" target="_blank" class="btn btn-outline-dark w-100">
                        <i class="bi bi-map me-2"></i> Ver Plano
                    </a>
                @endif
                </div>
            </div>
        </div>

        {{-- Video embebido --}}
        @if($subzona->video_url)
            <div class="mb-5 ratio ratio-16x9">
                <iframe src="{{ $subzona->video_url }}" frameborder="0" allowfullscreen></iframe>
            </div>
        @endif

        {{-- Mapa embebido --}}
        @if($subzona->iframe_mapa)
            <div class="mb-5">
                <h3 class="h5">Ubicación</h3>
                <div class="ratio ratio-16x9">
                    {!! $subzona->iframe_mapa !!}
                </div>
            </div>
        @endif
        <h2 class="h5 mb-4">Detalles de la Promoción</h2>
        {{-- Contenido HTML extendido --}}
        @if($subzona->contenido_html)
            <div class="mb-5">
                {!! $subzona->contenido_html !!}
            </div>
        @endif

        <h2 class="h5 mb-4">Galería de Imágenes</h2>
        {{-- Galería tipo mosaico --}}
        @if($subzona->imagenes && count($subzona->imagenes))
            <h2 class="h5 mb-4">Galería de imágenes</h2>
            <div class="row g-3 mb-5">
                @foreach($subzona->imagenes as $imagen)
                    <div class="col-6 col-md-4 col-lg-3">
                        <a href="{{ asset('storage/' . $imagen->path) }}" class="glightbox" data-gallery="gallery">
                            <img src="{{ asset('storage/' . $imagen->path) }}" class="img-fluid rounded shadow-sm" alt="Imagen">
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Propiedades relacionadas --}}
        @if($subzona->properties->count())
            <h2 class="h4 mb-4">Propiedades disponibles</h2>
            <div class="row gx-4 gy-4">
                @foreach($subzona->properties as $property)
                    <div class="col-md-6 col-lg-4">
                        @include('partials.property.card', ['property' => $property])
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection

@section('scripts')
    <script src="{{ asset('js/glightbox.min.js') }}"></script>
    <script>GLightbox({ selector: '.glightbox' });</script>
@endsection

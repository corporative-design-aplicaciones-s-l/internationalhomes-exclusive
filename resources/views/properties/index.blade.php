@extends('layouts.guest')

@section('title', 'Propiedades en venta')

@section('content')
    {{-- Buscador --}}
    {{-- Estilos de fondo como Kaza --}}
    <div class="bg-light py-4 border-bottom">
        <form method="GET" action="{{ route('properties.index') }}" class="container">
            <div class="row g-2 align-items-center justify-content-center">
                {{-- Tipo de propiedad --}}
                <div class="col-md-2 dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">
                        Tipo de propiedad
                    </button>
                    <ul class="dropdown-menu p-2" style="width: 100%;">
                        <li><label><input type="checkbox" name="types[]" value="piso" class="form-check-input me-2">
                                Piso</label></li>
                        <li><label><input type="checkbox" name="types[]" value="casa" class="form-check-input me-2">
                                Casa</label></li>
                        <li><label><input type="checkbox" name="types[]" value="villa" class="form-check-input me-2">
                                Villa</label></li>
                    </ul>
                </div>

                {{-- Área --}}
                <div class="col-md-2 dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button"
                        data-bs-toggle="dropdown">
                        Área
                    </button>
                    <ul class="dropdown-menu p-2" style="width: 100%;">
                        <li><label><input type="checkbox" name="types[]" value="piso" class="form-check-input me-2">
                                50 m²</label></li>
                        <li><label><input type="checkbox" name="types[]" value="casa" class="form-check-input me-2">
                                100 m²</label></li>
                        <li><label><input type="checkbox" name="types[]" value="villa" class="form-check-input me-2">
                                200 m²</label></li>
                    </ul>
                </div>

                {{-- Ubicación --}}
                <div class="col-md-2 dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button"
                        data-bs-toggle="dropdown">
                        Población </button>
                    <ul class="dropdown-menu p-2" style="width: 100%;">
                        <li><label><input type="checkbox" name="types[]" value="piso" class="form-check-input me-2">
                                Madrid</label></li>
                        <li><label><input type="checkbox" name="types[]" value="casa" class="form-check-input me-2">
                                Barcelona</label></li>
                        <li><label><input type="checkbox" name="types[]" value="villa" class="form-check-input me-2">
                                Alicante</label></li>
                    </ul>
                </div>

                {{-- Precio --}}
                <div class="col-md-2 dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button"
                        data-bs-toggle="dropdown">
                        Precio </button>
                    <ul class="dropdown-menu p-2" style="width: 100%;">
                        <li><label><input type="checkbox" name="types[]" value="piso" class="form-check-input me-2">
                                Hasta 500.000 €</label></li>
                        <li><label><input type="checkbox" name="types[]" value="casa" class="form-check-input me-2">
                                Hasta 1.000.000 €</label></li>
                        <li><label><input type="checkbox" name="types[]" value="villa" class="form-check-input me-2">
                                Hasta 1.500.000 €</label></li>
                    </ul>
                </div>

                {{-- Más filtros (opcional modal) --}}
                <div class="col-md-2 d-flex gap-2">
                    <button type="button" class="btn btn-outline-dark w-100" data-bs-toggle="modal"
                        data-bs-target="#filtersModal">
                        <i class="bi bi-sliders"></i> Más filtros
                    </button>

                    {{-- Botón mostrar --}}
                    <button type="submit" class="btn btn-main w-100 d-flex justify-content-center align-items-center">
                        <i class="bi bi-search me-2"></i> Mostrar
                    </button>
                </div>
        </form>

        {{-- Modal más filtros --}}
        <!-- Modal Más Filtros -->
        <div class="modal fade" id="filtersModal" tabindex="-1" aria-labelledby="filtersModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content rounded-4">
                    <div class="modal-header">
                        <h5 class="modal-title" id="filtersModalLabel">Más filtros</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <!-- Características (Izquierda) -->
                            <div class="col-md-6">
                                <h6 class="mb-3">Características</h6>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="features[]" value="piscina"
                                        id="piscina">
                                    <label class="form-check-label" for="piscina">Piscina</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="features[]" value="terraza"
                                        id="terraza">
                                    <label class="form-check-label" for="terraza">Terraza</label>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="features[]" value="jardin"
                                        id="jardin">
                                    <label class="form-check-label" for="jardin">Jardín</label>
                                </div>
                            </div>

                            <!-- Otros (Derecha) -->
                            <div class="col-md-6">
                                <h6 class="mb-3">Otros</h6>
                                <div class="mb-3">
                                    <label for="vistas" class="form-label">Vistas</label>
                                    <select class="form-select" id="vistas" name="views">
                                        <option value="">Seleccionar</option>
                                        <option value="mar">Mar</option>
                                        <option value="montaña">Montaña</option>
                                        <option value="ciudad">Ciudad</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="habitaciones" class="form-label">Habitaciones</label>
                                    <select class="form-select" id="habitaciones" name="bedrooms">
                                        <option value="">Seleccionar</option>
                                        <option value="1">1+</option>
                                        <option value="2">2+</option>
                                        <option value="3">3+</option>
                                        <option value="4">4+</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="bano" class="form-label">Baños</label>
                                    <select class="form-select" id="bano" name="bathrooms">
                                        <option value="">Seleccionar</option>
                                        <option value="1">1+</option>
                                        <option value="2">2+</option>
                                        <option value="3">3+</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Estado de la propiedad -->
                        <h6 class="mt-3">Estado de la propiedad</h6>
                        <div class="d-flex gap-3">
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="state" id="allProperties"
                                    value="all" checked>
                                <label class="form-check-label" for="allProperties">Todas las propiedades</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="state" id="onlyReventa"
                                    value="reventa">
                                <label class="form-check-label" for="onlyReventa">Solo reventas</label>
                            </div>
                            <div class="form-check">
                                <input type="radio" class="form-check-input" name="state" id="onlyNewConstruction"
                                    value="new">
                                <label class="form-check-label" for="onlyNewConstruction">Solo nueva construcción</label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-main w-100">Aplicar filtros</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="pt-5">
        <div class="container">
            <h1 class="mb-4 fw-light text-center">Propiedades en venta</h1>

            {{-- Grid de propiedades --}}
            <div class="row gx-0 gy-4">
                @forelse($properties as $property)
                    <div class="card mb-4 border-0 shadow-sm overflow-hidden">
                        <div class="row g-0">
                            {{-- Imagen --}}
                            <div class="col-md-4">
                                <a href="{{ route('property.show', $property->slug) }}">
                                    <img src="{{ $property->image }}" alt="{{ $property->title }}" class="w-100 h-100"
                                        style="object-fit: cover; aspect-ratio: 4/3;">
                                </a>
                            </div>

                            {{-- Detalles --}}
                            <div class="col-md-8 d-flex flex-column justify-content-between p-3">
                                {{-- Encabezado --}}
                                <div>
                                    <p class="text-muted small mb-1">
                                        {{ $property->location ?? 'Ubicación desconocida' }}
                                        {{-- - Ref: {{ $property->id }} --}}
                                    </p>
                                    <h5 class="mb-2">
                                        <a href="{{ route('property.show', $property->slug) }}"
                                            class="text-decoration-none text-dark">
                                            {{ $property->title }}
                                        </a>
                                    </h5>

                                    <p class="text-muted small">
                                        {{ Str::limit($property->description, 200) }}
                                    </p>
                                </div>

                                {{-- Iconos + precio --}}
                                <div class="d-flex justify-content-between align-items-end">
                                    <div class="text-muted small d-flex gap-3">
                                        <span><i class="bi bi-house-door me-1"></i>{{ $property->area }} m²</span>
                                        <span><i class="bi bi-door-open me-1"></i>{{ $property->bedrooms }} hab</span>
                                        <span><i class="bi bi-bucket me-1"></i>{{ $property->bathrooms }} baños</span>
                                    </div>

                                    <div class="text-primary fw-semibold fs-5">
                                        €{{ number_format($property->price, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($property->tag)
                        <span
                            class="position-absolute top-0 start-0 m-2 badge bg-warning text-dark">{{ $property->tag }}</span>
                    @endif
                @empty
                    <div class="text-center py-5">
                        <p>No se encontraron propiedades.</p>
                    </div>
                @endforelse
            </div>

            {{-- Paginación --}}
            <div class="d-flex justify-content-center">
                {{ $properties->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>
@endsection

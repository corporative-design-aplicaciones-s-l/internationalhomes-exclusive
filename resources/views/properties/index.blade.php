@extends('layouts.guest')

@section('title', 'Propiedades en venta')

@section('style')
    <link href="{{ asset('css/properties.css') }}" rel="stylesheet">
    <style>
        .favorite-btn {
            background-color: rgba(255, 255, 255, 0.9);
            transition: background-color 0.2s;
        }

        .favorite-btn:hover {
            background-color: rgba(240, 240, 240, 1);
        }
    </style>
@endsection

@section('content')

    {{-- Buscador --}}
    <div class="bg-light py-4 border-bottom">
        <form method="GET" action="{{ route('admin.properties.index') }}" class="container">
            <div class="row g-2 align-items-center justify-content-center">
                {{-- Tipo de propiedad --}}
                <div class="col-md-2 dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button"
                        data-bs-toggle="dropdown">
                        {{ __('propertyIndex.type') }}
                    </button>
                    <ul class="dropdown-menu p-2" style="width: 100%;">
                        <li><label><input type="checkbox" name="types[]" value="piso" class="form-check-input me-2">
                                {{ __('propertyIndex.piso') }}</label></li>
                        <li><label><input type="checkbox" name="types[]" value="casa" class="form-check-input me-2">
                                {{ __('propertyIndex.casa') }}</label></li>
                        <li><label><input type="checkbox" name="types[]" value="villa" class="form-check-input me-2">
                                {{ __('propertyIndex.villa') }}</label></li>
                    </ul>
                </div>

                {{-- Área --}}
                <div class="col-md-2 dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button"
                        data-bs-toggle="dropdown">
                        {{ __('propertyIndex.area') }}
                    </button>
                    <ul class="dropdown-menu p-2" style="width: 100%;">
                        <li><label><input type="checkbox" name="area[]" value="50" class="form-check-input me-2">50
                                m²</label></li>
                        <li><label><input type="checkbox" name="area[]" value="100" class="form-check-input me-2">100
                                m²</label></li>
                        <li><label><input type="checkbox" name="area[]" value="200" class="form-check-input me-2">200
                                m²</label></li>
                    </ul>
                </div>

                {{-- Ubicación --}}
                <div class="col-md-2 dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button"
                        data-bs-toggle="dropdown">
                        {{ __('propertyIndex.location') }}
                    </button>
                    <ul class="dropdown-menu p-2" style="width: 100%;">
                        <li><label><input type="checkbox" name="city[]" value="madrid"
                                    class="form-check-input me-2">Madrid</label></li>
                        <li><label><input type="checkbox" name="city[]" value="barcelona"
                                    class="form-check-input me-2">Barcelona</label></li>
                        <li><label><input type="checkbox" name="city[]" value="alicante"
                                    class="form-check-input me-2">Alicante</label></li>
                    </ul>
                </div>

                {{-- Precio --}}
                <div class="col-md-2 dropdown">
                    <button class="btn btn-outline-secondary dropdown-toggle w-100" type="button"
                        data-bs-toggle="dropdown">
                        {{ __('propertyIndex.price') }}
                    </button>
                    <ul class="dropdown-menu p-2" style="width: 100%;">
                        <li><label><input type="checkbox" name="price[]" value="500000"
                                    class="form-check-input me-2">{{ __('propertyIndex.price_500k') }}</label></li>
                        <li><label><input type="checkbox" name="price[]" value="1000000"
                                    class="form-check-input me-2">{{ __('propertyIndex.price_1m') }}</label></li>
                        <li><label><input type="checkbox" name="price[]" value="1500000"
                                    class="form-check-input me-2">{{ __('propertyIndex.price_1_5m') }}</label></li>
                    </ul>
                </div>

                {{-- Más filtros --}}
                <div class="col-md-3 d-flex gap-2">
                    <button type="button" class="btn btn-outline-dark w-100" data-bs-toggle="modal"
                        data-bs-target="#filtersModal">
                        <i class="bi bi-sliders"></i> {{ __('propertyIndex.more_filters') }}
                    </button>
                    <button type="submit" class="btn btn-main w-100 d-flex justify-content-center align-items-center">
                        <i class="bi bi-search me-2"></i> {{ __('propertyIndex.show') }}
                    </button>
                </div>
        </form>

        {{-- Modal --}}
        <div class="modal fade" id="filtersModal" tabindex="-1" aria-labelledby="filtersModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content rounded-4">
                    <div class="modal-header">
                        <h5 class="modal-title" id="filtersModalLabel">{{ __('propertyIndex.more_filters') }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="{{ __('propertyIndex.close') }}"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            {{-- Características --}}
                            <div class="col-md-6">
                                <h6 class="mb-3">{{ __('propertyIndex.features') }}</h6>
                                @foreach (['piscina' => 'pool', 'terraza' => 'terrace', 'jardin' => 'garden'] as $key => $label)
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="features[]"
                                            value="{{ $key }}" id="{{ $key }}">
                                        <label class="form-check-label"
                                            for="{{ $key }}">{{ __('propertyIndex.' . $label) }}</label>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Otros --}}
                            <div class="col-md-6">
                                <h6 class="mb-3">{{ __('propertyIndex.others') }}</h6>

                                <div class="mb-3">
                                    <label for="vistas" class="form-label">{{ __('propertyIndex.views') }}</label>
                                    <select class="form-select" id="vistas" name="views">
                                        <option value="">{{ __('propertyIndex.select') }}</option>
                                        <option value="mar">{{ __('propertyIndex.sea') }}</option>
                                        <option value="montaña">{{ __('propertyIndex.mountain') }}</option>
                                        <option value="ciudad">{{ __('propertyIndex.city') }}</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="habitaciones"
                                        class="form-label">{{ __('propertyIndex.bedrooms') }}</label>
                                    <select class="form-select" id="habitaciones" name="bedrooms">
                                        <option value="">{{ __('propertyIndex.select') }}</option>
                                        <option value="1">1+</option>
                                        <option value="2">2+</option>
                                        <option value="3">3+</option>
                                        <option value="4">4+</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="bano" class="form-label">{{ __('propertyIndex.bathrooms') }}</label>
                                    <select class="form-select" id="bano" name="bathrooms">
                                        <option value="">{{ __('propertyIndex.select') }}</option>
                                        <option value="1">1+</option>
                                        <option value="2">2+</option>
                                        <option value="3">3+</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        {{-- Estado --}}
                        <h6 class="mt-3">{{ __('propertyIndex.state') }}</h6>
                        <div class="d-flex gap-3">
                            @foreach (['all' => 'all_properties', 'reventa' => 'resale', 'new' => 'new'] as $value => $label)
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="state"
                                        id="state-{{ $value }}" value="{{ $value }}"
                                        {{ $value === 'all' ? 'checked' : '' }}>
                                    <label class="form-check-label"
                                        for="state-{{ $value }}">{{ __('propertyIndex.' . $label) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit"
                            class="btn btn-main w-100">{{ __('propertyIndex.apply_filters') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="pt-5">
        <div class="container">
            <h1 class="mb-4 fw-light text-center">{{ __('propertyIndex.page_title') }}</h1>

            {{-- Grid --}}
            <div class="row gx-0 gy-4">
                @forelse($properties as $property)
                    @include('partials.property.card', ['property' => $property])
                @empty
                    <div class="text-center py-5">
                        <p>{{ __('propertyIndex.no_results') }}</p>
                    </div>
                @endforelse
            </div>

            {{-- Paginación --}}
            <div class="d-flex justify-content-center">
                {{ $properties->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </section>

    {{-- Últimas vistas --}}
    @if (session('recent_properties'))
        @include('partials.property.recent')
    @endif

    {{-- Favoritas --}}
    <section class="text-center my-5">
        <a href="{{ route('guest.properties.favorites') }}" class="btn btn-dark px-5 py-3">
            <i class="bi bi-heart-fill me-2"></i> {{ __('propertyIndex.view_favorites') }}
        </a>
    </section>
@endsection

@section('scripts')
    <script>
        function getFavorites() {
            const favs = document.cookie
                .split('; ')
                .find(row => row.startsWith('favorites='));

            return favs ? favs.split('=')[1].split(',').map(Number) : [];
        }

        function saveFavorites(favs) {
            document.cookie = `favorites=${favs.join(',')}; path=/; max-age=${60 * 60 * 24 * 30}`;
            console.table(document.cookie);
        }

        document.addEventListener('DOMContentLoaded', () => {
            const favorites = getFavorites();

            document.querySelectorAll('.favorite-btn').forEach(btn => {
                const id = parseInt(btn.dataset.id);

                // Inicializar icono
                if (favorites.includes(id)) {
                    btn.classList.add('active');
                    btn.querySelector('i').classList.remove('bi-heart');
                    btn.querySelector('i').classList.add('bi-heart-fill');
                }

                btn.addEventListener('click', () => {
                    let favs = getFavorites();

                    if (favs.includes(id)) {
                        favs = favs.filter(f => f !== id);
                        btn.classList.remove('active');
                        btn.querySelector('i').classList.remove('bi-heart-fill');
                        btn.querySelector('i').classList.add('bi-heart');
                    } else {
                        favs.push(id);
                        btn.classList.add('active');
                        btn.querySelector('i').classList.remove('bi-heart');
                        btn.querySelector('i').classList.add('bi-heart-fill');
                    }

                    saveFavorites(favs);
                });
            });
        });
    </script>
@endsection

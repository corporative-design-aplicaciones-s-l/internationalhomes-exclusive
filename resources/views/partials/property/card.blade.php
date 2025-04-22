<div class="card mb-4 border-0 shadow-sm overflow-hidden position-relative">
    <div class="row g-0">
        {{-- Imagen --}}
        <div class="col-md-4">
            <a href="{{ route('guest.property.show', ['locale' => app()->getLocale(), $property->slug])}}">
                <img src="{{ asset('storage/' . $property->thumbnail) }}" alt="{{ $property->title }}"
                    class="w-100 h-100" style="object-fit: cover; aspect-ratio: 4/3;">
            </a>
        </div>

        {{-- Detalles --}}
        <div class="col-md-8 d-flex flex-column justify-content-between p-3">
            <div>
                <p class="text-muted small mb-1">
                    {{ $property->location ?? 'Ubicación desconocida' }}
                </p>
                <h5 class="mb-2">
                    <a href="{{ route('guest.property.show', ['locale' => app()->getLocale(), $property->slug]) }}"
                        class="text-decoration-none text-dark">
                        {{ $property->title }}
                    </a>
                </h5>
                <p class="text-muted small">
                    {{ Str::limit($property->description, 200) }}
                </p>
            </div>

            <div class="d-flex justify-content-between align-items-end">
                <div class="text-muted small d-flex gap-3">
                    <span><i class="bi bi-house-door me-1"></i>{{ number_format($property->area / 100, 2, ',', '.') }} m²</span>
                    <span><i class="bi bi-door-open me-1"></i>{{ $property->bedrooms }} hab</span>
                    <span><i class="bi bi-bucket me-1"></i>{{ $property->bathrooms }} baños</span>
                </div>
                <div class="text-primary fw-semibold fs-5">
                    €{{ number_format($property->price, 0, ',', '.') }}
                </div>
            </div>
        </div>
    </div>

    {{-- Favorito --}}
    @php
        $favs = explode(',', request()->cookie('favorites', ''));
        $isFav = in_array($property->id, $favs);
    @endphp

    <btn
        class="link text-danger position-absolute top-0 end-0 m-2 favorite-btn {{ $isFav ? 'active' : '' }}"
        data-id="{{ $property->id }}">
        <i class="bi {{ $isFav ? 'bi-heart-fill' : 'bi-heart' }}"></i>
    </button>

    @if ($property->tag)
        <span
            class="position-absolute top-0 start-0 m-2 badge bg-warning text-dark">{{ $property->tag }}</span>
    @endif
</div>

<section class="py-5" style="background-color: #f7f7f7;" data-aos="fade-up">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <small class="text-uppercase text-muted">{{ __('home.featured_properties') }}</small>
                <h2 class="fw-light mt-2">{{ __('home.dream_title') }}</h2>
            </div>
            <a href="{{ route('guest.properties.index', ['locale' => app()->getLocale()]) }}" class="text-decoration-none text-dark fw-semibold text-uppercase small">
                {{ __('home.view_all') }} <i class="fas fa-chevron-right ms-1"></i>
            </a>
        </div>

        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                @foreach ($featured as $property)
                    <div class="swiper-slide fade-in-up">
                        <div class="bg-white rounded-4 shadow-sm overflow-hidden position-relative p-3">
                            <a href="{{ route('guest.property.show', ['locale' => app()->getLocale(), $property->slug]) }}">
                                <img src="{{ asset('storage/' . $property->thumbnail) }}" class="w-100 rounded-3 mb-3" style="aspect-ratio: 4/3; object-fit: cover;" alt="{{ $property->title }}">
                            </a>
                            <div class="mb-2 d-flex gap-2">
                                <span class="badge bg-warning text-bg-dark text-uppercase small">{{ __('home.exclusive') }}</span>
                                @if ($property->vista_al_mar)
                                    <span class="badge bg-primary text-white text-uppercase small">{{ __('home.sea_view') }}</span>
                                @endif
                            </div>
                            <div class="d-flex justify-content-between text-muted small mb-3 text-center">
                                <div><i class="fas fa-ruler-combined d-block mb-1"></i>{{ number_format($property->area / 100, 2, ',', '.') }} m²</div>
                                <div><i class="fas fa-expand d-block mb-1"></i>{{ number_format($property->metros_solar / 100, 2, ',', '.') }} m²</div>
                                <div><i class="fas fa-bed d-block mb-1"></i>{{ $property->bedrooms ?? '-' }}</div>
                                <div><i class="fas fa-bath d-block mb-1"></i>{{ $property->bathrooms ?? '-' }}</div>
                                <div><i class="fas fa-warehouse d-block mb-1"></i>{{ $property->tipo ?? '-' }}</div>
                            </div>
                            <h6 class="fw-bold text-uppercase mb-0 text-black">{{ Str::upper(Str::limit($property->subzona->zona->nombre, 20)) }}</h6>
                            <div class="text-muted text-capitalize fw-normal">Condado de Alhama</div>
                            <small class="text-uppercase text-muted">{{ ucfirst($property->tipo) }} · {{ __('home.new_build') }}</small>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <span class="badge bg-black text-white text-uppercase">Ref: {{ $property->ref }}</span>
                                <strong class="text-dark fs-5">{{ number_format($property->price, 0, ',', '.') }} €</strong>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

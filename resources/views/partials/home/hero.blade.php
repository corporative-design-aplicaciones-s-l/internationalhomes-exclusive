<section class="swiper heroSwiper">
    <div class="swiper-wrapper">
        @foreach (['/images/hero1.jpg', '/images/hero2.jpg', '/images/hero3.jpg'] as $img)
            <div class="swiper-slide position-relative hero-slide" style="height: 80vh;">
                <div class="w-100 h-100" style="background: url('{{ $img }}') center center / cover no-repeat;"></div>
                <div class="container h-100 d-flex align-items-center justify-content-center position-absolute top-0 start-0 end-0 bottom-0">
                    <div class="text-center text-white animate-hero">
                        <h1 class="display-4 fw-light">{{ __('home.discover_properties') }}</h1>
                        <p class="lead">{{ __('home.in_condado') }}</p>

                        {{-- Buscador --}}
                        <form action="{{ route('search', ['locale' => app()->getLocale()]) }}" method="GET" class="row g-2 mt-4 bg-white p-3 rounded shadow text-dark">
                            <div class="col-md-3">
                                <select name="type" class="form-select">
                                    <option value="">{{ __('home.location') }}</option>
                                    <option value="piso">Residencial Oriol</option>
                                    <option value="casa">Villas Atenea</option>
                                    <option value="villa">Villa</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select name="type" class="form-select">
                                    <option value="">{{ __('home.type') }}</option>
                                    <option value="bugalow">Bungalow</option>
                                    <option value="apartment">Apartamento</option>
                                    <option value="villa">Villa</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <input type="number" name="min_price" class="form-control" placeholder="{{ __('home.from_price') }}">
                            </div>
                            <div class="col-md-2">
                                <input type="number" name="max_price" class="form-control" placeholder="{{ __('home.to_price') }}">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-dark w-100">
                                    <i class="fas fa-search me-2"></i>
                                    <span class="d-none d-md-inline">{{ __('home.search', ['locale' => app()->getLocale()]) }}</span>
                                </button>
                            </div>
                        </form>

                        <a href="{{ route('contact', ['locale' => app()->getLocale()]) }}" class="btn btn-outline-light mt-3">
                            {{ __('home.have_questions') }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

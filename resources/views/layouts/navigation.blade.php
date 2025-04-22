<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3 sticky-top transition-navbar">
    <div class="container">
        <a class="navbar-brand fw-bold text-uppercase" href="{{ url('/') }}">
            <img src="{{ asset('images/logo/logo.svg') }}" alt="logo"
                style="height: 52px; transition: height 0.3s ease;">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav gap-3">
                <li class="nav-item">
                    <a class="nav-link"
                        href="{{ url('/', ['locale' => app()->getLocale()]) }}">{{ __('navbar.home') }}</a>
                </li>
                <li class="dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        {{ __('navbar.properties') }}
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="{{ route('guest.properties.index', ['locale' => app()->getLocale()]) }}">
                                {{ __('navbar.all_properties') }}
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        @foreach ($zonas as $zona)
                            <li>
                                <a class="dropdown-item" href="{{ route('zonas.show', ['locale' => app()->getLocale(), 'slug' => $zona->slug]) }}">
                                    {{ $zona->nombre }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="{{ route('environment', ['locale' => app()->getLocale()]) }}">{{ __('navbar.environment') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="{{ route('contact', ['locale' => app()->getLocale()]) }}">{{ __('navbar.contact') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="{{ route('guest.properties.favorites', ['locale' => app()->getLocale()]) }}">
                        <i class="bi bi-heart-fill me-1"></i> {{ __('navbar.favorites') }}
                    </a>
                </li>

                {{-- Selector de idioma --}}
                <div class="dropdown">
                    @php
                        function localized_url($locale)
                        {
                            $segments = request()->segments();
                            $segments[0] = $locale;
                            return url(implode('/', $segments));
                        }
                    @endphp
                    <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        {{ strtoupper(app()->getLocale()) }}
                    </button>
                    <ul class="dropdown-menu">
                        @foreach (['es', 'en', 'fr', 'de'] as $lang)
                            <li>
                                <a class="dropdown-item" href="{{ localized_url($lang) }}">
                                    {{ strtoupper($lang) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </ul>
        </div>
    </div>
</nav>

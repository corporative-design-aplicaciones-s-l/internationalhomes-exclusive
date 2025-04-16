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
                    <a class="nav-link" href="{{ url('/') }}">{{ __('navbar.home') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('guest.properties.index') }}">{{ __('navbar.properties') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('environment') }}">{{ __('navbar.environment') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">{{ __('navbar.contact') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('guest.properties.favorites') }}">
                        <i class="bi bi-heart-fill me-1"></i> {{ __('navbar.favorites') }}
                    </a>
                </li>

                {{-- Selector de idioma --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="langDropdown" role="button" data-bs-toggle="dropdown">
                        🌐 {{ strtoupper(app()->getLocale()) }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="langDropdown">
                        @foreach (['es' => 'ES', 'en' => 'EN', 'fr' => 'FR', 'de' => 'DE'] as $lang => $label)
                            <li>
                                <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}">
                                    {{ $label }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

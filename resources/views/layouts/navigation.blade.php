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
                    <a class="nav-link" href="{{ url('/') }}">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('guest.properties.index') }}">Propiedades</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">Nosotros</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('environment') }}">Entorno</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">Contacto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('guest.properties.favorites') }}">
                        <i class="bi bi-heart-fill me-1"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

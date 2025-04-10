<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ mix('css/backoffice.css') }}" rel="stylesheet">
    @yield('styles') <!-- Estilos específicos de cada página -->
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 bg-dark text-white">
                <div class="sidebar">
                    <h3 class="text-center">Backoffice</h3>
                    <ul class="nav flex-column">
                        <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a></li>
                        <li class="nav-item"><a href="{{ route('admin.properties.index') }}" class="nav-link">Propiedades</a></li>
                        <li class="nav-item"><a href="{{ route('admin.users.index') }}" class="nav-link">Usuarios</a></li>
                        <li class="nav-item"><a href="{{ route('admin.reports') }}" class="nav-link">Informes</a></li>
                        <li class="nav-item"><a href="{{ route('admin.settings') }}" class="nav-link">Configuración</a></li>
                    </ul>
                </div>
            </div>

            <!-- Contenido -->
            <div class="col-md-9">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>

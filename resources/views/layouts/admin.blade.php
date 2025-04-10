<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles') <!-- Aquí cargamos los estilos específicos de cada vista -->

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .sidebar {
            min-height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #1d1d1f;
            padding-top: 20px;
            padding-left: 15px;
            z-index: 1000;
            font-family: 'Poppins', sans-serif;
        }

        .sidebar h3 {
            font-weight: 600;
            color: white;
            margin-bottom: 30px;
            font-family: 'Poppins', sans-serif;

        }

        /* Asegura que los elementos del sidebar se alineen correctamente */
        .sidebar .nav-link {
            color: white;
            font-size: 16px;
            font-family: 'Poppins', sans-serif;

        }

        .sidebar .nav-link:hover {
            background-color: #333;
        }

        /* Contenido principal */
        .container-fluid {
            display: flex;
            flex-direction: row;
            background-color: #b0925531;
            height: 100vh;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        .content-container {
            flex-grow: 1;
            /* Toma todo el espacio disponible */
            padding: 30px;
            overflow-x: hidden;
            /* Evita el scroll horizontal */
            background-color: #f4f4f9;
        }

        .col-md-9 {
            margin-left: 250px;
            /* Deja espacio para el sidebar */
            padding: 30px;
            width: 100%;
            overflow-x: hidden;
            /* Evita el scroll horizontal */
            background-color: #f4f4f9;
            /* Fondo claro para el contenido */
        }

        h1 {
            font-weight: 600;
            color: #333;
            font-family: 'Poppins', sans-serif;
        }

        /* Botones del backoffice */
        .btn-main {
            background-color: #d4a52d;
            color: white;
            border-radius: 10px;
            font-weight: 500;
            padding: 8px 20px;
            width: 100%;
            font-family: 'Poppins', sans-serif;

        }

        .btn-main:hover {
            background-color: #000;
        }
    </style>
</head>

<body class="bg-backoffice">
    <div class="container-fluid d-flex p-0">
        <!-- Sidebar -->
        <div class="sidebar">
            <h3 class="text-center">
                <img src="{{ asset('images/domatia_logo.png') }}" alt="Domatia Logo" class="img-fluid mx-auto d-block"
                    style="max-width: 170px;">
            </h3>
            <ul class="nav flex-column">
                <li class="nav-item"><a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a></li>
                <li class="nav-item"><a href="{{ route('properties.index') }}" class="nav-link">Propiedades</a></li>
                <li class="nav-item"><a href="{{ route('users.index') }}" class="nav-link">Usuarios</a></li>
                <li class="nav-item"><a href="{{ route('admin.reports') }}" class="nav-link">Informes</a></li>
                <li class="nav-item"><a href="{{ route('admin.settings') }}" class="nav-link">Configuración</a></li>
            </ul>
        </div>

        <!-- Contenido principal -->
        <div class="content-container">
            @yield('content')
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}"></script> <!-- Si tienes JavaScript personalizado -->
</body>

</html>

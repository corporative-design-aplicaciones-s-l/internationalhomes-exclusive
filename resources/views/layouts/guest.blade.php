<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Domatia')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Segoe UI', 'Helvetica Neue', sans-serif;
            background-color: #fff;
            color: #222;
        }
        h1, h2, h3 {
            font-weight: 300;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    @include('layouts.navigation')

    <main class="pb-4">
        @yield('content')
    </main>

    <footer class="text-center text-muted border-top py-4 mt-5">
        © {{ date('Y') }} Domatia. Todos los derechos reservados.
    </footer>

    @stack('scripts')
</body>
</html>

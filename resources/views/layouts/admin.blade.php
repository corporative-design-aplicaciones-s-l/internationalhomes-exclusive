<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles') <!-- Aquí cargamos los estilos específicos de cada vista -->

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
        }

        .admin-layout {
            display: grid;
            grid-template-columns: 250px 1fr;
            height: 100vh;
        }

        .sidebar {
            background-color: #1d1d1f;
            padding: 20px 15px;
            color: white;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .sidebar h3 {
            text-align: center;
            margin-bottom: 2rem;
        }

        .sidebar .nav-link {
            color: white;
            padding: 8px 10px;
            display: block;
            font-weight: 500;
        }

        .sidebar .nav-link:hover {
            background-color: #333;
            border-radius: 6px;
        }

        .content-container {
            padding: 30px;
            background-color: #f4f4f9;
            height: 100vh;
            width: 100%;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .btn-main {
            background-color: #d4a52d;
            color: white;
            border-radius: 10px;
            font-weight: 500;
            padding: 8px 20px;
        }

        .btn-main:hover {
            background-color: #000;
        }

        .accordion-body {
            background-color: #2a2a2a;
            border-left: 3px solid #d4a52d;
            border-radius: 5px;
        }

        .nav .nav-link {
            font-family: 'Poppins', sans-serif;
        }

        #menu-toggle {
            display: none;
            font-size: 24px;
            background: none;
            border:
                #57575738;
        }

        .swiper-button-prev,
        .swiper-button-next {
            display: none !important;
        }

        img.border-success {
            box-shadow: 0 0 0 3px #198754 !important;
        }

        @media (max-width: 991.98px) {
            .admin-layout {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                width: 250px;
                height: 100vh;
                background-color: #1d1d1f;
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
                z-index: 1050;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            #menu-toggle {
                display: inline-block;
            }
        }
    </style>
</head>

<body class="bg-backoffice">
    <div class="container-fluid d-flex p-0">
        <!-- Botón hamburguesa visible solo en móvil -->
        <!-- Sidebar -->
        <div class="sidebar">
            <h3 class="text-center">
                <img src="{{ asset('images/domatia_logo.png') }}" alt="Domatia Logo" class="img-fluid mx-auto d-block"
                    style="max-width: 200px;">
            </h3>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <div class="nav flex-column" id="accordionNav">
                    <div class="accordion-item">
                        <!-- Acordeón para Contenido -->
                        <button class="nav-link collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#contenidoCollapse" aria-expanded="false" aria-controls="contenidoCollapse">
                            Contenido
                        </button>
                        <div id="contenidoCollapse" class="accordion-collapse collapse" data-bs-parent="#accordionNav">
                            <div class="accordion-body">
                                <ul class="nav flex-column ps-3">
                                    <li class="nav-item"><a class="nav-link" href="#">Traducciones</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Páginas</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="#">Emails</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Acordeón Propiedades -->
                    <div class="accordion-item">
                        <button class="nav-link collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#propiedadesCollapse" aria-expanded="false"
                            aria-controls="propiedadesCollapse">
                            Propiedades
                        </button>
                        <div id="propiedadesCollapse" class="accordion-collapse collapse"
                            data-bs-parent="#accordionNav">
                            <div class="accordion-body">
                                <ul class="nav flex-column ps-3">
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('admin.properties.index') }}">Propiedades</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link"
                                            href="{{ route('admin.zonas.index') }}">Zonas</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="#">Contactos</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- Acordeón para Admin -->

                    <div class="accordion-item">
                        <button class="nav-link collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#adminCollapse" aria-expanded="false" aria-controls="adminCollapse">
                            Admin
                        </button>
                        <div id="adminCollapse" class="accordion-collapse collapse" data-bs-parent="#accordionNav">
                            <div class="accordion-body">
                                <ul class="nav flex-column ps-3">
                                    <li class="nav-item"><a class="nav-link" href="#">Admins</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="#">Logs</a>
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="#">Contactos</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <li class="nav-item">
                    <!-- Enlace de Logout -->
                    <form action="{{ route('logout') }}" method="POST" id="logout-form" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link">
                            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                        </button>
                    </form>

                </li>
            </ul>
        </div>


        <!-- Contenido principal -->
        <div class="content-container">
            <!-- Botón hamburguesa visible solo en móvil -->
            <button id="menu-toggle" class="btn btn-main d-lg-none mb-3 text-black" aria-label="Abrir menú">
                &#9776; <!-- símbolo de tres rayas -->
            </button>

            @yield('content')

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggle = document.getElementById("menu-toggle");
            const sidebar = document.querySelector(".sidebar");

            toggle.addEventListener("click", () => {
                sidebar.classList.toggle("open");
            });
        });

        @yield('scripts')
    </script>


</body>

</html>

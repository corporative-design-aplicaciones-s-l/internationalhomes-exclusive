<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Página en construcción</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            background: #1e1e2f;
            color: white;
            font-family: sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        p {
            font-size: 1.2rem;
            max-width: 600px;
        }

        a {
            color: #ffcc00;
            text-decoration: none;
            margin-top: 2rem;
            display: inline-block;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Estamos trabajando en algo genial</h1>
    <p>La web está en construcción, pero muy pronto estará disponible.</p>

    {{-- Entrada secreta --}}
    {{-- <a href="{{ url('/puerta-trasera') }}">.</a> --}}
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/devoluciones.css') }}">
    <title>Devoluciones</title>
    <noscript>
        <meta http-equiv="refresh" content="0;url={{ asset('../error/error.html') }}">
    </noscript>
</head>

<body>
    <div class="container">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="{{ url('/libros') }}">Libros</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/libros') }}">Ir a Libros</a>
                    </li>
                </ul>
            </div>
        </nav>

        <h1>Devoluciones</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Préstamo</th>
                    <th>Fecha de Devolución</th>
                </tr>
            </thead>
            <tbody>
                @foreach($devoluciones as $devolucion)
                <tr data-id="{{ $devolucion->ID_Devolucion }}">
                    <td>{{ $devolucion->ID_Devolucion }}</td>
                    <td>
                        @if($devolucion->prestamo)
                            {{ $devolucion->prestamo->usuario->Nombre }} {{ $devolucion->prestamo->usuario->Apellido }}
                        @else
                            Sin préstamo asociado
                        @endif
                    </td>
                    <td>{{ $devolucion->Fecha_Devolucion }}</td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>

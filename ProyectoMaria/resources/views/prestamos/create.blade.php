<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/realizarPrestamo.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Prestamos</title>
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

        <div class="container mt-4">
            <h1>Realizar Préstamo</h1>
            <form action="{{ route('prestamos.store') }}">
                @csrf
                <div class="form-group">
                    <label for="libro_id">Libro:</label>
                    <select class="form-control" id="libro_id" name="libro_id">
                        @foreach ($librosDisponibles as $libro)
                            <option value="{{ $libro->ID_Libro }}">{{ $libro->Titulo }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="usuario_id">Cliente:</label>
                    <select class="form-control" id="usuario_id" name="usuario_id">
                        @foreach ($usuarios as $usuario)
                            <option value="{{ $usuario->ID_Usuario }}">{{ $usuario->Nombre }} {{ $usuario->Apellido }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="fecha_prestamo">Fecha de Préstamo:</label>
                    <input type="date" class="form-control" id="fecha_prestamo" name="fecha_prestamo"
                        value="{{ date('Y-m-d') }}" required>
                </div>
                <button class="btn btn-primary" onclick="realizarPrestamo()">Realizar Préstamo</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/crudPrestamos.js') }}"></script>

</body>

</html>

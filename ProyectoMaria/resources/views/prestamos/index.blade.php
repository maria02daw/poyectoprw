<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/prestamos.css') }}">
    <noscript>
        <meta http-equiv="refresh" content="0;url={{ asset('../error/error.html') }}">
    </noscript>
    <title>Prestamos</title>
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

        <h1>Préstamos</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Libro</th>
                    <th>Fecha de Préstamo</th>
                    <th>Fecha de Devolución Prevista</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prestamos as $prestamo)
                    <tr data-id="{{ $prestamo->ID_Prestamo }}"
                        @if ($prestamo->oculto) class="hidden-row" @endif>
                        <td>{{ $prestamo->ID_Prestamo }}</td>
                        <td>{{ $prestamo->usuario->Nombre }} {{ $prestamo->usuario->Apellido }}</td>
                        <td>{{ $prestamo->libro->Titulo }}</td>
                        <td>{{ $prestamo->Fecha_Prestamo }}</td>
                        <td>{{ $prestamo->Fecha_Devolucion_Prevista }}</td>
                        <td>
                            <button class="btn btn-warning btn-sancionar"
                                data-id="{{ $prestamo->ID_Prestamo }}">Sancionar</button>
                            <button class="btn btn-danger btn-delete"
                                data-id="{{ $prestamo->ID_Prestamo }}">Borrar</button>
                            <a href="{{ route('devoluciones.insertar', ['prestamoId' => $prestamo->ID_Prestamo]) }}"
                                class="btn btn-info btn-agregar-devolucion"
                                data-prestamo-id="{{ $prestamo->ID_Prestamo }}">Agregar Devolución</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/crudDevoluciones.js') }}"></script>
    <script src="{{ asset('js/crudPrestamos.js') }}"></script>
    <script>
    // Ocultar filas
        $(document).ready(function() {
            $('.btn-agregar-devolucion').click(function() {
                var prestamoId = $(this).data('prestamo-id');
                $('tr[data-id="' + prestamoId + '"]').remove();
                localStorage.setItem('hiddenRow_' + prestamoId, true);
            });

            $('tr').each(function() {
                var prestamoId = $(this).data('id');
                if (localStorage.getItem('hiddenRow_' + prestamoId)) {
                    $(this).remove();
                }
            });
        });
    </script>

    <script>
        // Sancionar
        document.addEventListener('DOMContentLoaded', function() {
            var botonesSancionar = document.querySelectorAll('.btn-sancionar');
            botonesSancionar.forEach(function(boton) {
                boton.addEventListener('click', function() {
                    var prestamoId = this.dataset.id;
                    var row = document.querySelector('tr[data-id="' + prestamoId + '"]');


                    row.style.textDecoration = 'line-through';


                    localStorage.setItem('sancionado_' + prestamoId, true);



                    fetch('/sancionar-prestamo', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                prestamoId: prestamoId
                            })
                        })
                        .then(function(response) {
                            if (!response.ok) {
                                throw new Error('Ocurrió un error al sancionar el préstamo');
                            }

                        })
                        .catch(function(error) {
                            console.error('Error:', error);

                        });
                });
            });
        });


        $('tr').each(function() {
            var prestamoId = $(this).data('id');
            if (localStorage.getItem('sancionado_' + prestamoId)) {
                $(this).css('text-decoration', 'line-through');
            }
        });
    </script>
</body>

</html>

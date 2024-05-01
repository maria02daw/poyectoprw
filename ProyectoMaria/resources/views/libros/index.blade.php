<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Libros</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/libros.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Sección para manejo de token de sesión -->
    @if (session('token'))
        <input type="hidden" id="accessToken" value="{{ session('token') }}">
    @endif
    <!-- Redirección en caso de no tener JavaScript habilitado -->
    <noscript>
        <meta http-equiv="refresh" content="0;url={{ asset('../error/error.html') }}">
    </noscript>
</head>

<body>

    <div class="container mt-4">


        <!-- Menú de navegación -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Biblioteca María´s Books</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('libros.insertar') }}">Agregar Libro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('prestamos.index') }}">Préstamos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('devoluciones.index') }}">Devoluciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" onclick="logout()">Cerrar sesión</a>
                    </li>
                </ul>
            </div>
        </nav>
        <h1>Lista de Libros</h1>
        <!-- Botón para mostrar/ocultar la sección de búsqueda -->
        <button class="btn btn-secondary" onclick="toggleBusqueda()">
            <i class="fas fa-search"></i> Mostrar/Ocultar Búsqueda
        </button>
        <div id="busquedaContainer" style="display: none;">
            <!-- Contenedor de la sección de búsqueda -->
            <div class="form-group">
                <label for="nombreLibro">Buscar por Nombre:</label>
                <input type="text" class="form-control" id="nombreLibro" placeholder="Ingrese el nombre del libro">
                <button class="btn btn-primary mt-2" onclick="filtrarPorNombre()">Buscar</button>
            </div>
<!-- Formulario de filtrado por género -->
            <div class="form-group">
                <label for="generoLibro">Filtrar por Género:</label>
                <select class="form-control" id="generoLibro">
                    <option value="">Todos los Géneros</option>
                    <option value="Ficción">Ficción</option>
                    <option value="Fantasía">Fantasía</option>
                    <option value="Terror">Terror</option>
                    <option value="Poesía">Poesía</option>
                    <option value="Historia">Historia</option>
                    <option value="Infantil">Infantil</option>
                    <option value="Autoayuda">Autoayuda</option>
                    <option value="Novela Romántica">Novela Romántica</option>
                </select>
                <button class="btn btn-primary mt-2" onclick="filtrarPorGenero()">Filtrar</button>
            </div>
        </div>
<!-- Sección de libros -->
        @if ($libros && count($libros) > 0)
            @php
                $librosAgrupados = [];
            @endphp
<!-- Agrupación de libros por título -->
            @foreach ($libros as $libro)
                @php
                    $titulo = $libro->Titulo;
                    $genero = isset($libro->genero) ? $libro->genero : '';
                    $libroConGenero = (object) ['libro' => $libro, 'genero' => $genero];
                    $librosAgrupados[$titulo][] = $libroConGenero;
                @endphp
            @endforeach
  <!-- Iteración sobre los grupos de libros -->
            @foreach ($librosAgrupados as $titulo => $librosConTitulo)
                <h3 class="titulo-desplegable" data-titulo="{{ $titulo }}"
                    data-genero="{{ $librosConTitulo[0]->genero }}" style="cursor: pointer;">
                    {{ $titulo }} (<span
                        id="contadorLibros_{{ $titulo }}">{{ count($librosConTitulo) }}</span>)
                </h3>

                <table class="table mt-2 tabla-desplegable" style="display: none;">
                    <thead>
                        <tr>
                            <th>Autor</th>
                            <th>Portada</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($librosConTitulo as $libro)
                            <tr id="filaLibro_{{ $libro->libro->ID_Libro }}">
                                <td>{{ $libro->libro->autor }}</td>
                                <td>
                                    <img src="{{ asset('img/' . $libro->libro->Portada) }}" alt="Portada del libro"
                                        style="max-width: 100px; max-height: 100px;">
                                </td>
                                <td>{{ $libro->libro->estado }}</td>
                                <td>
                                    @if ($libro->libro->estado && $libro->libro->estado === 'Disponible')
                                        <a href="{{ route('prestamos.create', ['libro_id' => $libro->libro->ID_Libro]) }}"
                                            class="btn btn-primary">Realizar
                                            Préstamo</a>
                                    @endif
                                    <button class="btn btn-info"
                                        onclick="mostrarFormularioActualizar({{ $libro->libro->ID_Libro }})">Actualizar</button>
                                    <button class="btn btn-danger"
                                        onclick="eliminarLibro({{ $libro->libro->ID_Libro }}, '{{ $titulo }}')">Eliminar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        @else
            <p>No hay libros disponibles.</p>
        @endif
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <script src="{{ asset('js/crudLibros.js') }}"></script>
    <script src="{{ asset('js/crudPrestamos.js') }}"></script>
    <script src="{{ asset('js/filtros.js') }}"></script>
    <script src="{{ asset('js/login.js') }}"></script>


    <script>
        // Función para mostrar y ocultar la sección de búsqueda
        function toggleBusqueda() {
            const busquedaContainer = document.getElementById('busquedaContainer');

            if (busquedaContainer.style.display === 'none' || busquedaContainer.style.display === '') {
                busquedaContainer.style.display = 'block';
            } else {
                busquedaContainer.style.display = 'none';
            }
        }
    </script>

    <script>
        // Función para mostrar y ocultar la sección de libros
        document.addEventListener('DOMContentLoaded', function() {
            const titulosDesplegables = document.querySelectorAll('.titulo-desplegable');

            titulosDesplegables.forEach(function(titulo) {
                titulo.addEventListener('click', function() {
                    const tablaDesplegable = this.nextElementSibling;

                    if (tablaDesplegable.style.display === 'none' || tablaDesplegable.style
                        .display === '') {
                        tablaDesplegable.style.display = 'table';
                    } else {
                        tablaDesplegable.style.display = 'none';
                    }
                });
            });
        });
    </script>

</body>

</html>

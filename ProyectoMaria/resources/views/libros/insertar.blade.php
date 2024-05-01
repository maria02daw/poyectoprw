<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Libro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/insertarLibro.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <noscript>
        <meta http-equiv="refresh" content="0;url={{ asset('../error/error.html') }}">
    </noscript>
</head>
<body>

<div class="container mt-4">
    <h1>Insertar Libro</h1>

    <form id="insertarLibroForm">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" class="form-control" id="titulo" name="Titulo" required>
        </div>

        <div class="form-group">
            <label for="idAutor">Autor:</label>
            <select class="form-control" id="idAutor" name="ID_Autor" required>
                <option value="">Selecciona un autor</option>
                @foreach($autores as $autor)
                    <option value="{{ $autor->ID_Autor }}">{{ $autor->Nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="idEditorial">Editorial:</label>
            <select class="form-control" id="idEditorial" name="ID_Editorial" required>
                <option value="">Selecciona una editorial</option>
                @foreach($editoriales as $editorial)
                    <option value="{{ $editorial->ID_Editorial }}">{{ $editorial->Nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="idGenero">Género:</label>
            <select class="form-control" id="idGenero" name="ID_Genero" required>
                <option value="">Selecciona un género</option>
                @foreach($generos as $genero)
                    <option value="{{ $genero->ID_Genero }}">{{ $genero->Nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="idEstado">Estado:</label>
            <select class="form-control" id="idEstado" name="ID_Estado" required>
                <option value="">Selecciona un estado</option>
                @foreach($estados as $estado)
                    <option value="{{ $estado->ID_Estado }}">{{ $estado->Nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="isbn">ISBN:</label>
            <input type="text" class="form-control" id="isbn" name="ISBN" required>
        </div>

        <div class="form-group">
            <label for="portada">Portada:</label>
            <input type="text" class="form-control" id="portada" name="Portada" required>
        </div>

        <div class="form-group">
            <button id="btnInsertarLibro" class="btn btn-success">Insertar Libro</button>
        </div>
        <div class="form-group">
            <a href="/libros" class="btn btn-secondary">Volver a la Lista</a>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

<script src="{{ asset('js/crudLibros.js') }}"></script>
</body>
</html>

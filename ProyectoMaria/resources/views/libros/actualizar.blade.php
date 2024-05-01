<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/actualizarLibro.css') }}">
    <title>Actualizar Libro</title>
    <noscript>
        <meta http-equiv="refresh" content="0;url={{ asset('../error/error.html') }}">
    </noscript>
</head>
<body>
    <div class="container">
        <h1>Actualizar Libro</h1>

        <form id="actualizarLibroForm">
            <input type="hidden" id="idLibro" name="ID_Libro" value="{{ $libro->ID_Libro }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" class="form-control" id="titulo" name="Titulo" value="{{ $libro->Titulo }}" required>
            </div>

            <div class="form-group">
                <label for="idAutor">Autor:</label>
                <select class="form-control" id="idAutor" name="ID_Autor" required>
                    @foreach($autores as $autor)
                        <option value="{{ $autor->ID_Autor }}" @if($libro->ID_Autor == $autor->ID_Autor) selected @endif>{{ $autor->Nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="idEditorial">Editorial:</label>
                <select class="form-control" id="idEditorial" name="ID_Editorial" required>
                    @foreach($editoriales as $editorial)
                        <option value="{{ $editorial->ID_Editorial }}" @if($libro->ID_Editorial == $editorial->ID_Editorial) selected @endif>{{ $editorial->Nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="idGenero">Género:</label>
                <select class="form-control" id="idGenero" name="ID_Genero" required>
                    @foreach($generos as $genero)
                        <option value="{{ $genero->ID_Genero }}" @if($libro->ID_Genero == $genero->ID_Genero) selected @endif>{{ $genero->Nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="idEstado">Estado:</label>
                <select class="form-control" id="idEstado" name="ID_Estado" required>
                    @foreach($estados as $estado)
                        <option value="{{ $estado->ID_Estado }}" @if($libro->ID_Estado == $estado->ID_Estado) selected @endif>{{ $estado->Nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="isbn">ISBN:</label>
                <input type="text" class="form-control" id="isbn" name="ISBN" value="{{ $libro->ISBN }}" required>
            </div>

            <div class="form-group">
                <label for="portada">Portada:</label>
                <input type="text" class="form-control" id="portada" name="Portada" value="{{ $libro->Portada }}" required>
            </div>

            <div class="form-group">
                <button type="submit" id="btnActualizarLibro" class="btn btn-primary">Actualizar Libro</button>
            </div>
            <div class="form-group">
                <a href="{{ url('/libros') }}" class="btn btn-secondary">Volver al Índice</a>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/crudLibros.js') }}"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/agregarDevolucion.css') }}">
    <title>Agregar Devolución</title>
    <noscript>
        <meta http-equiv="refresh" content="0;url={{ asset('../error/error.html') }}">
    </noscript>
</head>

<body>
    <div class="container">
        <h1>Agregar Devolución</h1>
        <form id="form-agregar-devolucion" action="{{ route('devoluciones.store') }}" method="POST">
            <div class="form-group">
                <label for="fecha_devolucion">Fecha de Devolución:</label>
                <input type="date" class="form-control" id="fecha_devolucion" name="fecha_devolucion" required>
            </div>
            <input type="hidden" id="prestamo_id" name="prestamo_id" value="{{ $prestamoId }}">
            <button type="submit" class="btn btn-primary">Agregar Devolución</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/crudDevoluciones.js') }}"></script>

</body>

</html>

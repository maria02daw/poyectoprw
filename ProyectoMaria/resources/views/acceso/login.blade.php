<!-- resources/views/acceso/login.blade.php -->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Iniciar Sesión</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <noscript>
        <meta http-equiv="refresh" content="0;url={{ asset('../error/error.html') }}">
    </noscript>
</head>

<body>

    <div class="container mt-5">
        <div class="col-md-6 offset-md-3">
            <h2 class="mb-4">Iniciar Sesión</h2>

            <div id="errorAlert" class="alert alert-danger" style="display: none;">
                Credenciales inválidas
            </div>

            @if (session('token'))
                <div class="alert alert-success">
                    Token: {{ session('token') }}
                </div>
            @endif

            <form id="loginForm" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="perfil">Perfil:</label>
                    <input type="text" class="form-control" name="perfil" id="perfil" required>
                </div>


                <div class="form-group">
                    <label for="contraseña">Contraseña:</label>
                    <input type="password" class="form-control" name="contraseña" id="contraseña" required>
                </div>

                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('js/login.js') }}"></script>
</body>

</html>

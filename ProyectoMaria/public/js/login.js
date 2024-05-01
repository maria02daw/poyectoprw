//LOGIN

document.getElementById('loginForm').addEventListener('submit', function (event) {
    event.preventDefault();

    var perfil = document.getElementById('perfil').value;
    var contraseña = document.getElementById('contraseña').value;

    fetch('/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ perfil: perfil, contraseña: contraseña })
    })
    .then(response => {

        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
            return response.json();
        } else {

            window.location.href = response.url;
        }
    })
    .then(data => {
        if (data && data.token) {
            console.log('Token recibido:', data.token);
            window.location.href = '/libros';
        } else if (data && data.error) {
            console.error('Error de autenticación:', data.error);
            document.getElementById('errorAlert').style.display = 'block';
        } else {
            console.error('Respuesta inesperada:', data);
        }
    })
    .catch(error => {
        console.error('Error de red:', error);
    });
});

//LOGOUT

function logout() {
    const confirmacion = confirm('¿Estás seguro de que quieres cerrar sesión?');

    if (!confirmacion) {
        return;
    }

    fetch('/logout', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (response.ok) {
            window.location.href = '/login';
        } else {
            console.error('Error al cerrar sesión');
        }
    })
    .catch(error => console.error('Error al cerrar sesión', error));
}

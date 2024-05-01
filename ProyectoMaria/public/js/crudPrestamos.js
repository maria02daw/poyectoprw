//CRUD DE PRÉSTAMOS



// OBTENER PRÉSTAMOS
async function getPrestamos() {
    const apiUrl = '/api/mariaog/prestamos';

    try {
        const response = await fetch(apiUrl);

        if (!response.ok) {
            throw new Error(`Error al obtener préstamos. Código de estado: ${response.status}`);
        }


        const contentType = response.headers.get('content-type');
        if (contentType && contentType.indexOf('application/json') !== -1) {
            const prestamos = await response.json();
            actualizarVistaPrestamos(prestamos);
        }
    } catch (error) {
        console.error(error.message);
    }
}

// ACTUALIZAR VISTA PRÉSTAMOS

function actualizarVistaPrestamos(prestamos) {

    console.log(prestamos);
}

document.addEventListener('DOMContentLoaded', function() {
    getPrestamos();
});

$(document).on('click', '.btn-realizar-prestamo', function() {
    var libroId = $(this).data('libro-id');
    realizarPrestamo(libroId);
});

//REALIZAR PRESTAMO

function realizarPrestamo(libroId) {
    console.log(JSON.stringify({
        usuario_id: usuarioId,
        libro_id: libroId,
        fecha_prestamo: new Date().toISOString().split('T')[0]
    }));
    var usuarioId = document.getElementById('usuario_id').value;
    var libroId = document.getElementById('libro_id').value;
    fetch('/prestamos', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        body: JSON.stringify({
            usuario_id: usuarioId,
            libro_id: libroId,
            fecha_prestamo: new Date().toISOString().split('T')[0]
        })

    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Error al realizar el préstamo');
        }
        return response.json();
    })
    .then(data => {
        alert(data.message);

        window.location.href = '/prestamos';
    })
    .catch(error => {
        console.error('Error al realizar el préstamo:', error);
        alert('Error al realizar el préstamo: ' + error.message);
    });
}

// ELIMINAR PRÉSTAMO

document.addEventListener('DOMContentLoaded', function () {

    $(document).on('click', '.btn-delete', function () {
        var prestamoId = $(this).data('id');
        var filaPrestamo = $('tr[data-id="' + prestamoId + '"]');


        if (confirm('¿Estás seguro de que quieres eliminar este préstamo?')) {
            eliminarPrestamo(prestamoId, filaPrestamo);
        }
    });

    function eliminarPrestamo(prestamoId, filaPrestamo) {
        fetch('/prestamos/' + prestamoId, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al eliminar el préstamo');
            }
            return response.text();
        })
        .then(data => {

            console.log('Préstamo eliminado correctamente', data);

            filaPrestamo.hide();
            filaPrestamo.remove();
        })
        .catch(error => {
            console.error('Error al eliminar el préstamo:', error);
            alert('Error al eliminar el préstamo: ' + error.message);

            filaPrestamo.show();
        });
    }
});


$('.btn-devolver').click(function() {
    var prestamoId = $(this).data('id');
    window.location.href = '/devoluciones/insertar/' + prestamoId;
});

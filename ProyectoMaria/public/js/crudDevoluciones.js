//CRUD DE DEVOLUCIONES

document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('form-agregar-devolucion');
    if (form) {
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        var prestamoId = document.getElementById('prestamo_id').value;
        var fechaDevolucion = document.getElementById('fecha_devolucion').value;

        fetch('/devoluciones', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                fecha_devolucion: fechaDevolucion,
                prestamo_id: prestamoId
            })
        })
        .then(function(response) {
            if (!response.ok) {
                throw new Error('Error al agregar devolución');
            }
            return response.json();
        })
        .then(function(data) {
            console.log("Respuesta del servidor:", data);
            if (data.exito) {
                alert('Devolución agregada correctamente');
                window.location.href = '/devoluciones';
            } else {
                throw new Error('Error al agregar devolución');
            }
        })
        .catch(function(error) {
            alert(error.message);
            console.error(error);
        });
    });
}
});

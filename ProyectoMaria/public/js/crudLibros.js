//CRUD DE LIBROS

// OBTENER LIBROS
async function getLibros(accessToken) {
    try {
        const response = await fetch('/api/mariaog/libros', {
            headers: {
                'Authorization': 'Bearer ' + accessToken
            }
        });

        if (!response.ok) {
            throw new Error(`Error al obtener libros. Código de estado: ${response.status}`);
        }


        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
            const libros = await response.json();
            actualizarVistaLibros(libros);
        } else {
            console.error('La respuesta no está en formato JSON');
        }
    } catch (error) {
        console.error(error.message);
    }
}


function actualizarVistaLibros(libros) {

    console.log(libros);
}

// INSERTAR
function insertarLibro() {
    fetch('/api/mariaog/libros', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',

        },
        body: JSON.stringify({
            Titulo: $('#titulo').val(),
            ID_Autor: $('#idAutor').val(),
            ID_Editorial: $('#idEditorial').val(),
            ID_Genero: $('#idGenero').val(),
            ID_Estado: $('#idEstado').val(),
            ISBN: $('#isbn').val(),
            Portada: $('#portada').val(),
        }),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Error al insertar el libro. Código de estado: ${response.status}`);
        }
        console.log('Libro insertado con éxito');
        window.location.href = '/libros';
    })
    .catch(error => {
        console.error('Error al insertar el libro:', error);
    });
}

// BOTON DE INSERTAR
$(document).ready(function () {
    $('#btnInsertarLibro').on('click', function () {
        insertarLibro();
    });
});


// FORMULARIO DE ACTUALIZAR
function mostrarFormularioActualizar(ID_Libro, redirigir = true) {
    console.log('ID_Libro en mostrarFormularioActualizar:', ID_Libro);

    fetch(`/api/mariaog/libros/${ID_Libro}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error al obtener detalles del libro. Código de estado: ${response.status}`);
            }
            return response.json();
        })
        .then(libro => {
            console.log('Libro obtenido:', libro);


            if (typeof libro === 'object' && libro.Titulo) {
                $('#titulo').val(libro.Titulo);
                $('#idAutor').val(libro.ID_Autor);
                $('#idEditorial').val(libro.ID_Editorial);
                $('#idGenero').val(libro.ID_Genero);
                $('#idEstado').val(libro.ID_Estado);
                $('#isbn').val(libro.ISBN);
                $('#portada').val(libro.Portada);

                console.log('ID_Libro:', ID_Libro);
                $('#idLibro').val(ID_Libro);

                if (redirigir) {
                    window.location.href = `/libros/actualizar/${ID_Libro}`;
                }
            } else {
                console.error('Error: El libro obtenido no tiene la estructura esperada.');
            }

        })
        .catch(error => {
            console.error('Error al obtener detalles del libro:', error);
        });
}

// ACTUALIZAR
function actualizarLibro() {
    var ID_Libro = $('#idLibro').val();
    var datosLibro = {
        Titulo: $('#titulo').val(),
        ID_Autor: $('#idAutor').val(),
        ID_Editorial: $('#idEditorial').val(),
        ID_Genero: $('#idGenero').val(),
        ID_Estado: $('#idEstado').val(),
        ISBN: $('#isbn').val(),
        Portada: $('#portada').val()
    };

    fetch(`/api/mariaog/libros/${ID_Libro}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(datosLibro),
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Error al actualizar el libro. Código de estado: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Respuesta del servidor:', data);
        alert('Libro actualizado correctamente.');

    })
    .catch(error => {
        console.error('Error al actualizar el libro:', error);
        alert('Error al actualizar el libro. Por favor, inténtelo de nuevo.');
    });
}

$(document).ready(function () {
    $('#btnActualizarLibro').on('click', function () {
        console.log('Botón actualizarLibro clickeado');

        actualizarLibro();
    });
});


// ELIMINAR

function eliminarLibro(libroId, titulo) {
    const apiUrl = `/api/mariaog/libros/${libroId}`;

    fetch(apiUrl, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
        },
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Error al intentar eliminar el libro. Estado del servidor: ${response.status}`);
        }

        alert(`Libro con ID ${libroId} eliminado con éxito`);
        const filaLibro = document.getElementById(`filaLibro_${libroId}`);
        if (filaLibro) {
            filaLibro.remove();
            actualizarContador(titulo);
        }
        getLibros();
    })
    .catch(error => {
        console.error('Error al intentar eliminar el libro:', error);
    });
}

// FUNCIONES AUXILIARES

function actualizarContador(titulo) {
    const contadorElemento = document.getElementById(`contadorLibros_${titulo}`);
    if (contadorElemento) {
        const nuevoContador = parseInt(contadorElemento.textContent) - 1;
        contadorElemento.textContent = nuevoContador;
    }
}

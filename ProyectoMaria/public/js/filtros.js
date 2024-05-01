//FILTROS

//Filtrar por nombre
function filtrarPorNombre() {
    var nombreBusqueda = document.getElementById('nombreLibro').value.toLowerCase();
    var titulosDesplegables = document.querySelectorAll('.titulo-desplegable');

    titulosDesplegables.forEach(function (titulo) {
        var tituloLibro = titulo.getAttribute('data-titulo').toLowerCase();
        var tablaDesplegable = titulo.nextElementSibling;


        if (tituloLibro.includes(nombreBusqueda)) {
            tablaDesplegable.style.display = 'table';
        } else {
            tablaDesplegable.style.display = 'none';
        }


        titulo.style.display = tituloLibro.includes(nombreBusqueda) ? 'block' : 'none';
    });
}

//Filtrar por genero

function filtrarPorGenero() {
    var generoSeleccionado = document.getElementById('generoLibro').value.toLowerCase();
    var titulosDesplegables = document.querySelectorAll('.titulo-desplegable');

    titulosDesplegables.forEach(function (titulo) {
        var generoLibro = titulo.getAttribute('data-genero').toLowerCase();
        var tablaDesplegable = titulo.nextElementSibling;

        if (generoSeleccionado === '' || generoLibro === generoSeleccionado) {
            tablaDesplegable.style.display = 'table';
        } else {
            tablaDesplegable.style.display = 'none';
        }


        titulo.style.display = (generoSeleccionado === '' || generoLibro === generoSeleccionado) ? 'block' : 'none';
    });
}

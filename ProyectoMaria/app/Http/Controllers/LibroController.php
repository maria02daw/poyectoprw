<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use App\Http\Resources\LibroCollection;
use App\Models\Autor;
use App\Models\Estado;
use App\Models\Editorial;
use App\Models\Genero;
use App\Http\Controllers\LibroDBController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AccesoController;

class LibroController extends Controller
{
    protected $accesoController;
    protected $libroDBController;


    public function __construct(AccesoController $accesoController, LibroDBController $libroDBController)
    {
        $this->accesoController = $accesoController;
        $this->libroDBController = $libroDBController;
    }


    /**
     * Muestra todos los libros. Metodo GET
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

            $libros = $this->libroDBController->getLibros();

            if (request()->is('api/mariaog/libros')) {
                return response()->json(['data' => $libros]);
            } else {
                $checked =  $this->accesoController->checkAuthentication($request);
        if ($checked) {
                return view('libros.index', compact('libros'));

        }else {
            return redirect('/login');
        }
    }
}

    /**
     * Muestra un libro específico por ID. Metodo GET
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ID_Libro)
    {

        return $this->libroDBController->getLibroByID($ID_Libro);


    }

    /**
     * Muestra el formulario para agregar un nuevo libro.
     *
     * @return \Illuminate\Contracts\View\View
     */

    public function create(Request $request)
    {
        $checked = $this->accesoController->checkAuthentication($request);
        if ($checked) {
        $autores = Autor::all();
        $editoriales = Editorial::all();
        $generos = Genero::all();
        $estados = Estado::all();

        return view('libros.insertar', ['autores' => $autores, 'editoriales' => $editoriales, 'generos' => $generos, 'estados' => $estados]);
        }else {
            return redirect('/login');
        }
    }


    /**
     * Almacena un nuevo libro en la base de datos. Metodo POST
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'Titulo' => 'required|string',
            'ID_Autor' => 'required|integer',
            'ID_Editorial' => 'required|integer',
            'ID_Genero' => 'required|integer',
            'ID_Estado' => 'required|integer',
            'ISBN' => 'required|string|max:13',
            'Portada' => 'string|max:255',
        ]);

        return $this->libroDBController->addLibro($request);


    }

    /**
     * Muestra el formulario para editar un libro específico.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(Request $request, $id)
{

    $libro = $this->libroDBController->getLibroByID($id);

    if ($libro->getStatusCode() === 404) {
        return response()->json(['error' => 'Libro no encontrado'], 404);
    }

    $autores = Autor::all();
    $editoriales = Editorial::all();
    $generos = Genero::all();
    $estados = Estado::all();

    $checked = $this->accesoController->checkAuthentication($request);
    if ($checked) {
    return view('libros.actualizar', [
        'libro' => (object) json_decode($libro->getContent(), true),
        'autores' => $autores,
        'editoriales' => $editoriales,
        'generos' => $generos,
        'estados' => $estados,
    ]);
    }else {
        return redirect('/login');
    }

}
    /**
     * Actualiza un libro existente en la base de datos. Metodo PUT
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{

    $libro = $this->libroDBController->getLibroByID($id);

    if ($libro->getStatusCode() === 404) {
        return response()->json(['error' => 'Libro no encontrado'], 404);
    }

    $request->validate([
        'Titulo' => 'required|string',
        'ID_Autor' => 'required|integer',
        'ID_Editorial' => 'required|integer',
        'ID_Genero' => 'required|integer',
        'ID_Estado' => 'required|integer',
        'ISBN' => 'required|string|max:13',
        'Portada' => 'string|max:255',
    ]);

    try {

        $this->libroDBController->updateLibro($request, $id);

        return redirect('/libros/actualizar/' . $id)->with('ID_Libro', $id);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al actualizar el libro: ' . $e->getMessage()], 500);
    }

}

     /**
      * Elimina un libro específico por ID de la base de datos. Metodo DELETE
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
        return $this->libroDBController->deleteLibro($id);
     }





}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autor;
use App\Http\Resources\AutorCollection;

class AutorController extends Controller
{
      /**
     * Muestra todos los Autores.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $autores = Autor::all();
        return new AutorCollection($autores);
    }

    /**
     * Muestra un autor específico por ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ID_Autor)
    {
        $autor = Autor::find($ID_Autor);

        if (!$autor) {
            return response()->json(['error' => 'Autor no encontrado'], 404);
        }

        return response()->json($autor);
    }
}

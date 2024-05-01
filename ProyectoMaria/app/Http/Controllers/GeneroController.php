<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genero;
use App\Http\Resources\GeneroCollection;

class GeneroController extends Controller
{
          /**
     * Muestra todos los Generos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $generos = Genero::all();
        return new GeneroCollection($generos);
    }

    /**
     * Muestra un genero específico por ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ID_Genero)
    {
        $genero = Genero::find($ID_Genero);

        if (!$genero) {
            return response()->json(['error' => 'Genero no encontrado'], 404);
        }

        return response()->json($genero);
    }

}

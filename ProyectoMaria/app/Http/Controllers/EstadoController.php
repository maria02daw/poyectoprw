<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estado;
use App\Http\Resources\EstadoCollection;

class EstadoController extends Controller
{
      /**
     * Muestra todos los posibles estados.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estados = Estado::all();
        return new EstadoCollection($estados);
    }

    /**
     * Muestra un estado específico por ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ID_Estado)
    {
        $estado = Estado::find($ID_Estado);

        if (!$estado) {
            return response()->json(['error' => 'Estado no introducido'], 404);
        }

        return response()->json($estado);
    }
}

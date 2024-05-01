<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Http\Resources\UsuarioCollection;


class UsuarioController extends Controller
{
        /**
     * Muestra todos los Usuarios.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = Usuario::all();
        return new UsuarioCollection($usuarios);
    }

    /**
     * Muestra un usuario específico por ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ID_Usuario)
    {
        $usuario = Usuario::find($ID_Usuario);

        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        return response()->json($usuario);
    }

    
}

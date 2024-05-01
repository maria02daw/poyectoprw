<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Editorial;
use App\Http\Resources\EditorialCollection;

class EditorialController extends Controller
{
    /**
     * Muestra todas las editoriales.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $editoriales = Editorial::all();
        return new EditorialCollection($editoriales);
    }

    /**
     * Muestra una editorial específica por ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ID_Editorial)
    {
        $editorial = Editorial::find($ID_Editorial);

        if (!$editorial) {
            return response()->json(['error' => 'Editorial no encontrada'], 404);
        }

        return response()->json($editorial);
    }
}

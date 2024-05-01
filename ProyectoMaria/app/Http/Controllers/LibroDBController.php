<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Libro;

class LibroDBController extends Controller
{
    public function getLibros()
    {
        $libros = DB::select('
            SELECT libros.*, autores.Nombre AS autor, estado.Nombre AS estado, generos.Nombre AS genero
            FROM libros
            LEFT JOIN autores ON libros.ID_Autor = autores.ID_Autor
            LEFT JOIN estado ON libros.ID_Estado = estado.ID_Estado
            LEFT JOIN generos ON libros.ID_Genero = generos.ID_Genero
        ');

        return $libros;
    }

    public function getLibroByID($ID_Libro)
{
    $libro = DB::table('libros')
        ->join('autores', 'libros.ID_Autor', '=', 'autores.ID_Autor')
        ->join('editoriales', 'libros.ID_Editorial', '=', 'editoriales.ID_Editorial')
        ->join('generos', 'libros.ID_Genero', '=', 'generos.ID_Genero')
        ->join('estado', 'libros.ID_Estado', '=', 'estado.ID_Estado')
        ->select(
            'libros.*',
            'autores.Nombre as autor',
            'editoriales.Nombre as editorial',
            'generos.Nombre as genero',
            'estado.Nombre as estado'
        )
        ->where('ID_Libro', $ID_Libro)
        ->first();

    if (!$libro) {
        return response()->json(['error' => 'Libro no encontrado'], 404);
    }

    return response()->json($libro, 200);
}

    public function addLibro(Request $request)
    {
        $tituloLibro=$request->input('Titulo');
        $autorLibro=$request->input('ID_Autor');
        $editorialLibro=$request->input('ID_Editorial');
        $generoLibro=$request->input('ID_Genero');
        $estadoLibro=$request->input('ID_Estado');
        $isbn=$request->input('ISBN');
        $portada=$request->input('Portada');

        DB::insert('insert into libros ( Titulo, ID_Autor, ID_Editorial, ID_Genero, ID_Estado, ISBN, Portada) values ( ?, ?, ?, ?, ?, ?, ?)', [ $tituloLibro, $autorLibro, $editorialLibro, $generoLibro, $estadoLibro, $isbn, $portada]);

        return redirect ('/');

    }

    public function deleteLibro($ID_Libro)
    {
        DB::table('libros')->where('ID_Libro', $ID_Libro)->delete();
    }

    public function updateLibro(Request $request, $ID_Libro)
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

    $tituloLibro = $request->input('Titulo');
    $autorLibro = $request->input('ID_Autor');
    $editorialLibro = $request->input('ID_Editorial');
    $generoLibro = $request->input('ID_Genero');
    $estadoLibro = $request->input('ID_Estado');
    $isbn = $request->input('ISBN');
    $portada = $request->input('Portada');

    DB::table('libros')
        ->where('ID_Libro', $ID_Libro)
        ->update([
            'Titulo' => $tituloLibro,
            'ID_Autor' => $autorLibro,
            'ID_Editorial' => $editorialLibro,
            'ID_Genero' => $generoLibro,
            'ID_Estado' => $estadoLibro,
            'ISBN' => $isbn,
            'Portada' => $portada,
        ]);

    return redirect('/');
}

}

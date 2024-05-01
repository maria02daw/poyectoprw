<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\GeneroController;
use App\Http\Controllers\EditorialController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\LibroDBController;
use App\Http\Controllers\DevolucionController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'mariaog'], function () {
    Route::apiResource('libros', LibroController::class);
    Route::apiResource('autores', AutorController::class);
    Route::apiResource('estado', EstadoController::class);
    Route::apiResource('generos', GeneroController::class);
    Route::apiResource('editoriales', EditorialController::class);
    Route::apiResource('usuarios', UsuarioController::class);
    Route::apiResource('prestamos', PrestamoController::class);
    Route::apiResource('devoluciones', DevolucionController::class);



    Route::get('libros/{ID_Libro}', [LibroController::class, 'show']);
    Route::get('autores/{ID_Autor}', [AutorController::class, 'show']);
    Route::get('estado/{ID_Estado}', [EstadoController::class, 'show']);
    Route::get('generos/{ID_Genero}', [GeneroController::class, 'show']);
    Route::get('editoriales/{ID_Editorial}', [EditorialController::class, 'show']);
    Route::get('usuarios/{ID_Usuario}', [UsuarioController::class, 'show']);
    Route::get('prestamos/{ID_Prestamo}', [PrestamoController::class, 'show']);
    Route::get('devoluciones/{ID_Devolucion}', [DevolucionController::class, 'show']);


    Route::delete('/prestamos/{id}', 'PrestamoController@destroy');

    //Route::post('prestamos/{libroId}/realizar', [PrestamoController::class, 'realizarPrestamo']);

    // Route::delete('/mariaog/libros/{id}', [LibroDBController::class, 'deleteLibro']);


 });




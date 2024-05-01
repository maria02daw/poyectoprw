<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\LibroDBController;
use App\Http\Controllers\AccesoController;
use App\Http\Controllers\DevolucionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Principal
Route::get('/', function () {
    return view('acceso.login');
});
Route::get('/libros', [LibroController::class, 'index'])->name('libros.index');
//Libros
Route::get('/libros/insertar', [LibroController::class, 'create'])->name('libros.insertar');
Route::get('/libros/actualizar/{id}', [LibroController::class, 'edit'])->name('libros.actualizar');
Route::put('/libros/actualizar/{id}', [LibroController::class, 'update']);




//Prestamos
Route::get('/prestamos', [PrestamoController::class, 'index'])->name('prestamos.index');
Route::resource('prestamos', PrestamoController::class);
Route::post('/sancionar-prestamo', [PrestamoController::class, 'sancionarPrestamo'])->name('sancionar-prestamo');


//Devoluciones
Route::get('/devoluciones', [DevolucionController::class, 'index'])->name('devoluciones.index');
Route::get('/devoluciones/insertar/{prestamoId}', [DevolucionController::class, 'create'])->name('devoluciones.insertar');
Route::post('/devoluciones/insertar/{prestamoId}', [DevolucionController::class, 'store']);
Route::resource('devoluciones', DevolucionController::class);

//Login
Route::get('/login', [AccesoController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AccesoController::class, 'login']);
Route::post('/logout', [AccesoController::class, 'logout'])->name('logout');

//Error


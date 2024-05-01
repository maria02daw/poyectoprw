<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Prestamo;

class PrestamoDBController extends Controller
{

    public function getPrestamos()
    {
        $prestamos = DB::select('SELECT * FROM prestamos');
        return $prestamos;
    }

    public function getPrestamoByID($ID_Prestamo)
    {
        $prestamo = DB::table('prestamos')->where('ID_Prestamo', $ID_Prestamo)->first();
        return $prestamo;
    }

    public function addPrestamo(Request $request)
    {
        $prestamo = new Prestamo;
        $prestamo->ID_Libro = $request->input('ID_Libro');
        $prestamo->ID_Usuario = $request->input('ID_Usuario');
        $prestamo->Fecha_Prestamo = now();
        $prestamo->Fecha_Devolucion_Prevista = now()->addDays(10);

        DB::table('prestamos')->insert([
            'ID_Libro' => $prestamo->ID_Libro,
            'ID_Usuario' => $prestamo->ID_Usuario,
            'Fecha_Prestamo' => $prestamo->Fecha_Prestamo,
            'Fecha_Devolucion_Prevista' => $prestamo->Fecha_Devolucion_Prevista
        ]);

    }

    public function eliminarPrestamo($id)
    {
        DB::table('prestamos')->where('ID_Prestamo', $id)->delete();

    }
}

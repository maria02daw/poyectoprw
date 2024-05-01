<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\DevolucionCollection;
use App\Models\Devolucion;
use App\Http\Controllers\AccesoController;
use App\Models\Prestamo;
use App\Models\Libro;
use Illuminate\Support\Facades\Log;


class DevolucionController extends Controller
{

    protected $accesoController;
    public function __construct( AccesoController $accesoController)
    {

        $this->accesoController = $accesoController;
    }
    /**
     * Muestra todas las devoluciones.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request)
{



    $devoluciones = Devolucion::all();
    
    if (request()->is('api/mariaog/devoluciones')) {
        return response()->json(['data' => $devoluciones]);
    } else {
        $checked = $this->accesoController->checkAuthentication($request);
    if ($checked) {
        return view('devoluciones.index', compact('devoluciones'));


    }else {
        return redirect('/login');
    }
}
}

    /**
     * Muestra una devolución específica por ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $devolucion = Devolucion::find($id);

        if (!$devolucion) {
            return response()->json(['error' => 'Devolución no encontrada'], 404);
        }

        return response()->json($devolucion);
    }

    /**
     * Muestra el formulario para crear una nueva devolución.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $prestamoId)
    {
        $checked = $this->accesoController->checkAuthentication($request);
        if ($checked) {

        return view('devoluciones.insertar', ['prestamoId' => $prestamoId]);
    }else {
        return redirect('/login');
    }
    }

    /**
     * Almacena una nueva devolución en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
        $request->validate([
            'prestamo_id' => 'required|exists:prestamos,ID_Prestamo',
            'fecha_devolucion' => 'required|date',
        ]);


        $devolucion = new Devolucion();
        $devolucion->ID_Prestamo = $request->prestamo_id;
        $devolucion->Fecha_Devolucion = $request->input('fecha_devolucion');
        $devolucion->save();


        $prestamo = Prestamo::find($request->prestamo_id);
        if ($prestamo) {
            $libro = $prestamo->libro;
            if ($libro) {
                $libro->ID_Estado = 1;
                $libro->save();
            }
        }



        $prestamoId = $request->input('prestamo_id');

        $exito = true;


        return response()->json(['exito' => $exito, 'prestamoId' => $request->prestamo_id]);
    } catch (\Exception $e) {
        Log::error('Error al agregar devolución: ' . $e->getMessage());
        return response()->json(['exito' => false, 'error' => 'Error interno del servidor'], 500);
    }
    }


}

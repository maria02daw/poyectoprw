<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestamo;
use App\Http\Resources\PrestamoCollection;
use App\Http\Controllers\PrestamoDBController;
use App\Http\Controllers\AccesoController;
use App\Models\Usuario;
use App\Models\Libro;
use App\Models\Devolucion;
use Illuminate\Support\Facades\DB;

class PrestamoController extends Controller
{
    protected $accesoController;
    protected $prestamoDBController;
    public function __construct(PrestamoDBController $prestamoDBController, AccesoController $accesoController)
    {
        $this->prestamoDBController = $prestamoDBController;
        $this->accesoController = $accesoController;
    }

    /**
     * Muestra todos los préstamos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $prestamos = $this->prestamoDBController->getPrestamos();
        $prestamos = Prestamo::with('usuario', 'libro')->get();
        if (request()->wantsJson() || request()->expectsJson() || request()->ajax()) {
            return response()->json(['data' => $prestamos]);
        } else {
            $checked = $this->accesoController->checkAuthentication($request);
        if ($checked) {
            return view('prestamos.index', compact('prestamos'));

        }else {
            return redirect('/login');
        }

    }
}

    /**
     * Muestra un préstamo específico por ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ID_Prestamo)
    {
        $prestamo = Prestamo::find($ID_Prestamo);

        if (!$prestamo) {
            return response()->json(['error' => 'Préstamo no encontrado'], 404);
        }

        return response()->json($prestamo);
    }

     /**
     * Muestra el formulario para crear un nuevo préstamo.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $checked = $this->accesoController->checkAuthentication($request);
        if ($checked) {
        $librosDisponibles = \App\Models\Libro::where('ID_Estado', 1)->get();
        $usuarios = Usuario::all();
        return view('prestamos.create', compact('librosDisponibles', 'usuarios'));
        }else {
            return redirect('/login');
        }
    }

    /**
     * Almacena un nuevo préstamo en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,ID_Usuario',
            'libro_id' => 'required|exists:libros,ID_Libro',
            'fecha_prestamo' => 'required|date',
        ]);


        $libro = Libro::find($request->libro_id);
        if (!$libro || $libro->ID_Estado !== 1) {
            return response()->json(['error' => 'El libro no está disponible para préstamo'], 400);
        }


        $prestamo = new Prestamo();
        $prestamo->ID_Usuario = $request->usuario_id;
        $prestamo->ID_Libro = $request->libro_id;
        $prestamo->Fecha_Prestamo = $request->fecha_prestamo;
        $fecha_prestamo = new \DateTime($request->fecha_prestamo);
        $fecha_devolucion_prevista = $fecha_prestamo->modify('+10 days')->format('Y-m-d');

        $prestamo->Fecha_Devolucion_Prevista = $fecha_devolucion_prevista;
        $prestamo->save();


        $libro->ID_Estado = 2;
        $libro->save();

        return response()->json(['message' => 'Préstamo realizado con éxito'], 200);
    }

    /**
     * Elimina un préstamo específico por ID de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prestamo = Prestamo::find($id);

        if (!$prestamo) {
            return response()->json(['error' => 'Préstamo no encontrado'], 404);
        }



        $id_libro = $prestamo->ID_Libro;


        $prestamo->delete();

        if (!is_null($id_libro)) {

            $libro = Libro::find($id_libro);
            if ($libro) {
                $libro->ID_Estado = 1;
                $libro->save();
            }
        }

        return response()->json(['message' => 'Préstamo eliminado correctamente'], 204);
    }

    public function sancionarPrestamo(Request $request)
    {
        $prestamoId = $request->input('prestamoId');

        $prestamo = Prestamo::find($prestamoId);

        if ($prestamo) {

            if ($prestamo->libro) {
                $prestamo->libro->ID_Estado = 4;
                $prestamo->libro->save();
            }

            return response()->json(['message' => 'Prestamo sancionado correctamente']);
        } else {
            return response()->json(['error' => 'No se encontró el préstamo'], 404);
        }
    }

}

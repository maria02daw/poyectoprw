<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acceso;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\AccesoDBController;
use Carbon\Carbon;

class AccesoController extends Controller
{
    protected $accesoDBController;

    public function __construct(AccesoDBController $accesoDBController)
    {
        $this->accesoDBController = $accesoDBController;
    }


    public function showLoginForm()
    {
        return view('acceso.login');
    }


    public function login(Request $request)
    {
        $credentials = $request->only('perfil', 'contraseña');
        logger('Credenciales recibidas:', $credentials);

        $acceso = Acceso::where('perfil', $credentials['perfil'])
            ->where('contraseña', $credentials['contraseña'])
            ->first();

            if ($acceso) {
                $request->session()->put('perfil', $credentials['perfil']);
                if ($acceso->token) {

                    return response()->json(['token' => $acceso->token], 200);
                } else {

                    $token = $this->accesoDBController->generarToken($acceso->usuario->ID_Usuario);
                    $fechaCreacion = Carbon::now();
                    $fechaExpiracion = $fechaCreacion->copy()->addDays(7);
                    $acceso->token = $token;
                    $acceso->fecha = $fechaCreacion;
                    $acceso->fecha_expiracion = $fechaExpiracion;
                    $acceso->save();
                    return response()->json(['token' => $token], 200);
                }
            }

        return response()->json(['error' => 'Credenciales inválidas'], 401);
    }

    public function checkAuthentication(Request $request)
    {

        return $this->accesoDBController->checkAuthentication($request);
    }


    public function logout(Request $request)
    {

        $token = $request->header('Authorization');
       
        $acceso = Acceso::where('token', $token)->first();

        if ($acceso) {

            $acceso->token = null;
            $acceso->fecha = null;
            $acceso->fecha_expiracion = null;
            $acceso->save();
        }


        $request->session()->flush();


        return response()->json(['message' => 'Sesión cerrada exitosamente'], 200);
    }
}

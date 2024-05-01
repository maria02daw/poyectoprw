<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Acceso;
use App\Models\Usuario;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Str;

class AccesoDBController extends Controller
{

    protected $session;

    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }


    public function getToken(Request $request)
{

    $usuarioId = $request->usuario()->ID_Usuario;
    $tokenData = $this->getValidToken($usuarioId);

    if ($tokenData) {

        return response()->json([
            'token' => $tokenData->Token,
            'expiracion' => $tokenData->Fecha_Expiracion,
        ]);
    }

    try {
        $nuevoToken = $this->generarToken($usuarioId);
    } catch (\Exception $e) {

        \Log::error('Error al generar token: ' . $e->getMessage());

        return response()->json(['error' => 'Error al generar token'], 500);
    }


    $acceso = $this->guardarToken($usuarioId, $nuevoToken);

    if ($acceso) {

        return response()->json([
            'token' => $nuevoToken,
            'expiracion' => now()->addDays(7),
        ]);
    } else {

        return response()->json(['error' => 'Error al guardar el token en la base de datos'], 500);
    }
}


public function getValidToken($usuarioId)
{
    return Acceso::where('ID_Usuario', $usuarioId)
        ->where('Fecha_Expiracion', '>', now())
        ->first(); 
}

    public function generarToken($usuarioId)
    {
        try {
            return Str::random(60);
        } catch (\Exception $e) {
            \Log::error('Error al generar token: ' . $e->getMessage());
            throw $e;
        }
    }

    public function guardarToken($usuarioId, $token)
{
    try {
        \Log::info("Guardando token para usuario $usuarioId");

        $acceso = Acceso::create([
            'ID_Usuario' => $usuarioId,
            'Token' => $token,
            'Fecha' => now(),
            'Fecha_Expiracion' => now()->addDays(7),
        ]);


        return $acceso;
    } catch (\Exception $e) {

        \Log::error('Error al guardar token: ' . $e->getMessage());
        return null;
    }
}

    public function checkAuthentication(Request $request)
    {
        try{
            $perfil = $this->session->get('perfil');

            \Log::debug('Contenido de la sesión: ' . json_encode($request->session()->all()));

            if ($perfil) {
                $acceso = Acceso::where('perfil', $perfil)->first();
                $tokenData = $this->getValidToken($perfil);
                if ($acceso) {
                    $usuarioId = $acceso->ID_Usuario; // Obtenemos el ID_Usuario asociado con el perfil
                    $tokenData = $this->getValidToken($usuarioId);
                if ($tokenData) {
                    return true;
                }

                }
            }


            $request->session()->forget('perfil');

            return false;
        } catch(\Exception $e) {
            \Log::error('Error: ' . $e->getMessage());
            return null;
        }


    }
}

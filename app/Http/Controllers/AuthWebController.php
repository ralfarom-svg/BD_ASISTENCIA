<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\LogSesion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthWebController extends Controller
{
    /**
     * Mostrar login
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Procesar login
     */
    public function login(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required'
        ]);

        $usuario = Usuario::where('correo', $request->correo)
            ->where('activo_', 1)
            ->first();

        if (!$usuario || !Hash::check($request->password, $usuario->contrasenia_hash)) {
            return back()->withErrors([
                'correo' => 'Credenciales incorrectas'
            ]);
        }

        // Generar token de sesión
        $token = Str::uuid();

        // Registrar sesión
        LogSesion::create([
            'id_usuario' => $usuario->id_usuario,
            'fecha_ingreso' => now(),
            'hora_ingreso' => now()->format('H:i:s'),
            'estado' => 'activa',
            'direccion_ip' => $request->ip(),
            'dispositivo' => $request->userAgent(),
            'token' => $token,
        ]);

        // Guardar datos en sesión
        session([
            'usuario_id' => $usuario->id_usuario,
            'id_rol' => $usuario->id_rol,
            'nombre_usuario' => $usuario->nombre,
            'nombre_rol' => $usuario->rol->nombre_rol, 
            'token_sesion' => $token,
        ]);

        // ⏱ Último acceso
        $usuario->update([
            'ult_acceso' => now()
        ]);

        return redirect()->route('estudiantes.index');
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        LogSesion::where('token', session('token_sesion'))
            ->where('estado', 'ACTIVO')
            ->update([
                'fecha_fin' => now(),
                'hora_salida' => now()->format('H:i:s'),
                'estado' => 'CERRADO',
            ]);

        $request->session()->flush();

        return redirect()->route('login');
    }
}

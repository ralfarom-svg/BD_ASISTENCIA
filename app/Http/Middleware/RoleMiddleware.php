<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!session()->has('id_rol')) {
            return redirect()->route('login');
        }

        $rol = session('id_rol');

        $map = [
            'auxiliar' => 2,
            'director' => 3,
        ];

        foreach ($roles as $r) {
            if (isset($map[$r]) && $rol == $map[$r]) {
                return $next($request);
            }
        }

        abort(403, 'No tienes permiso');
    }
}

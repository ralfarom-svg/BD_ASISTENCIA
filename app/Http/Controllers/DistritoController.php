<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Distrito;
use App\Models\Justificacion;
use Illuminate\Http\Request;

class DistritoController extends Controller
{
    public function index()
    {
        return response()->json(Distrito::all());
    }

    public function store(Request $request)
    {
        $distrito = Distrito::create($request->all());
        return response()->json($distrito, 201);
    }

    public function show($id)
    {
        return response()->json(Distrito::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $distrito = Distrito::findOrFail($id);
        $distrito->update($request->all());
        return response()->json($distrito);
    }

    public function destroy($id)
    {
        Distrito::destroy($id);
        return response()->json(['message' => 'Distrito eliminado']);
    }

}

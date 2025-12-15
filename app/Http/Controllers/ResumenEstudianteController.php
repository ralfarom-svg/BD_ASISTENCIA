<?php

namespace App\Http\Controllers;

use App\Models\ResumenEstudiante;
use Illuminate\Http\Request;

class ResumenEstudianteController extends Controller
{
    public function index()
    {
        return response()->json(ResumenEstudiante::all());
    }

    public function store(Request $request)
    {
        $resumen = ResumenEstudiante::create($request->all());
        return response()->json($resumen, 201);
    }

    public function show($id)
    {
        return response()->json(ResumenEstudiante::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $resumen = ResumenEstudiante::findOrFail($id);
        $resumen->update($request->all());
        return response()->json($resumen);
    }

    public function destroy($id)
    {
        ResumenEstudiante::destroy($id);
        return response()->json(['message' => 'Resumen eliminado']);
    }
}

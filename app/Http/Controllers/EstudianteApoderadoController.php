<?php

namespace App\Http\Controllers;

use App\Models\EstudianteApoderado;
use Illuminate\Http\Request;

class EstudianteApoderadoController extends Controller
{
    public function index()
    {
        return response()->json(EstudianteApoderado::all());
    }

    public function store(Request $request)
    {
        $relacion = EstudianteApoderado::create($request->all());
        return response()->json($relacion, 201);
    }

    public function show($id_estudiante, $id_apoderado, $id_e_p)
    {
        return response()->json(
            EstudianteApoderado::where([
                ["Id_estudiante", $id_estudiante],
                ["id_apoderado", $id_apoderado],
                ["id_e_p", $id_e_p]
            ])->firstOrFail()
        );
    }

    public function update(Request $request, $id_estudiante, $id_apoderado, $id_e_p)
    {
        $relacion = EstudianteApoderado::where([
            ["Id_estudiante", $id_estudiante],
            ["id_apoderado", $id_apoderado],
            ["id_e_p", $id_e_p]
        ])->firstOrFail();

        $relacion->update($request->all());
        return response()->json($relacion);
    }

    public function destroy($id_estudiante, $id_apoderado, $id_e_p)
    {
        EstudianteApoderado::where([
            ["Id_estudiante", $id_estudiante],
            ["id_apoderado", $id_apoderado],
            ["id_e_p", $id_e_p]
        ])->delete();

        return response()->json(['message' => 'Relación eliminada']);
    }
}

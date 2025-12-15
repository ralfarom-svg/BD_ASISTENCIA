<?php

namespace App\Http\Controllers;

use App\Models\Apoderado;
use Illuminate\Http\Request;

class ApoderadoController extends Controller
{
    public function index()
    {
        return response()->json(Apoderado::all());
    }

    public function store(Request $request)
    {
        $apoderado = Apoderado::create($request->all());
        return response()->json($apoderado, 201);
    }

    public function show($id)
    {
        return response()->json(Apoderado::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $apoderado = Apoderado::findOrFail($id);
        $apoderado->update($request->all());
        return response()->json($apoderado);
    }

    public function destroy($id)
    {
        Apoderado::destroy($id);
        return response()->json(['message' => 'Apoderado eliminado']);
    }
}

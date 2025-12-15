<?php

namespace App\Http\Controllers;

use App\Models\RevisionJustificacion;
use Illuminate\Http\Request;

class RevisionJustificacionController extends Controller
{
    public function index()
    {
        return response()->json(RevisionJustificacion::all());
    }

    public function store(Request $request)
    {
        $revision = RevisionJustificacion::create($request->all());
        return response()->json($revision, 201);
    }

    public function show($id)
    {
        return response()->json(RevisionJustificacion::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $revision = RevisionJustificacion::findOrFail($id);
        $revision->update($request->all());
        return response()->json($revision);
    }

    public function destroy($id)
    {
        RevisionJustificacion::destroy($id);
        return response()->json(['message' => 'Revisión eliminada']);
    }
}

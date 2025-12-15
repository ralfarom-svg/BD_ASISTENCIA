<?php

namespace App\Http\Controllers;

use App\Models\LogSesion;
use Illuminate\Http\Request;

class LogSesionController extends Controller
{
    public function index()
    {
        return response()->json(LogSesion::all());
    }

    public function store(Request $request)
    {
        $log = LogSesion::create($request->all());
        return response()->json($log, 201);
    }

    public function show($id)
    {
        return response()->json(LogSesion::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $log = LogSesion::findOrFail($id);
        $log->update($request->all());
        return response()->json($log);
    }

    public function destroy($id)
    {
        LogSesion::destroy($id);
        return response()->json(['message' => 'Sesión eliminada']);
    }
}

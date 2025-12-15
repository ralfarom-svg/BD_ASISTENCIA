<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\AuditoriaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthWebController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\DirectorJustificacionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JustificacionController;
use App\Http\Controllers\UsuarioController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthWebController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthWebController::class, 'login'])
    ->name('login.post');

Route::post('/logout', [AuthWebController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| HOME (USUARIO LOGUEADO)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');


/*
|--------------------------------------------------------------------------
| ESTUDIANTES (AUXILIAR + DIRECTOR)
|--------------------------------------------------------------------------
*/
Route::middleware(['session.auth', 'role:auxiliar,director'])->group(function () {
    Route::get('/asistencias', [AsistenciaController::class, 'index'])
        ->name('asistencias.index');
    // LISTADO
    Route::get('/estudiantes', [EstudianteController::class, 'index'])
        ->name('estudiantes.index');

    // CREAR
    Route::get('/estudiantes/create', [EstudianteController::class, 'create'])
        ->name('estudiantes.create');

    Route::post('/estudiantes', [EstudianteController::class, 'store'])
        ->name('estudiantes.store');

    // ÉXITO
    Route::get('/estudiantes/exito/{id}', [EstudianteController::class, 'exito'])
        ->name('estudiantes.exito');

    // PDF
    Route::get('/estudiantes/pdf/{id}', [EstudianteController::class, 'generarPDF'])
        ->name('estudiantes.pdf');

    // VER
    Route::get('/estudiantes/{id}', [EstudianteController::class, 'show'])
        ->name('estudiantes.show');

    // EDITAR
    Route::get('/estudiantes/{id}/edit', [EstudianteController::class, 'edit'])
        ->name('estudiantes.edit');

    // UPDATE
    Route::put('/estudiantes/{id}', [EstudianteController::class, 'update'])
        ->name('estudiantes.update');

    // RETIRAR (destroy lógico)
    Route::delete('/estudiantes/{id}', [EstudianteController::class, 'destroy'])
        ->name('estudiantes.destroy');

    // Ver justificación (solo lectura)
    Route::get('justificaciones/{id}/show', [JustificacionController::class, 'show'])
        ->name('justificaciones.show');
});

/*
|--------------------------------------------------------------------------
| ASISTENCIA / ESCÁNER (AUXILIAR)
|--------------------------------------------------------------------------
*/
Route::middleware(['session.auth', 'role:auxiliar'])->group(function () {

    Route::get('/asistencia/escanear', [AsistenciaController::class, 'escanear'])
        ->name('asistencia.escanear');

    Route::post('/asistencia/registrar', [AsistenciaController::class, 'registrar'])
        ->name('asistencia.registrar');

    Route::get('/asistencia/exitosa/{id}', [AsistenciaController::class, 'exitosa'])
        ->name('asistencia.exitosa');
});

Route::middleware(['session.auth', 'role:auxiliar'])->group(function () {

    // JUSTIFICACIONES - AUXILIAR

    Route::get('/justificaciones/create/{id_asistencia}', [JustificacionController::class, 'create'])
        ->name('justificaciones.create');

    Route::post('/justificaciones', [JustificacionController::class, 'store'])
        ->name('justificaciones.store');

    Route::get('/justificaciones/{id}/edit', [JustificacionController::class, 'edit'])
        ->name('justificaciones.edit');

    Route::put('/justificaciones/{id}', [JustificacionController::class, 'update'])
        ->name('justificaciones.update');

    Route::delete('/justificaciones/{id}', [JustificacionController::class, 'destroy'])
        ->name('justificaciones.destroy');
});



/*
|--------------------------------------------------------------------------
| AUDITORÍAS (SOLO DIRECTOR)
|--------------------------------------------------------------------------
*/
Route::middleware(['session.auth', 'role:director'])->group(function () {

    Route::get('/auditorias', [AuditoriaController::class, 'index'])
        ->name('auditorias.index');

    Route::get('/auditorias/{id}', [AuditoriaController::class, 'show'])
        ->name('auditorias.show');

    Route::get(
        '/asistencias/resumen/{id}',
        [AsistenciaController::class, 'resumenPorEstudiante']
    )->name('asistencias.resumen');

    Route::get(
        '/director/justificaciones',
        [DirectorJustificacionController::class, 'index']
    )->name('director.justificaciones');

    Route::post(
        '/director/justificaciones/{id}/resolver',
        [DirectorJustificacionController::class, 'resolver']
    )->name('director.justificaciones.resolver');
});


Route::middleware(['role:director'])->group(function () {
    Route::get('/auditorias', [AuditoriaController::class, 'index'])
        ->name('auditorias.index');
});
Route::middleware(['session.auth', 'role:director,administrador'])->group(function () {
    // CRUD usuarios
    Route::get('/usuarios/crear', [UsuarioController::class, 'create'])
        ->name('usuarios.create');
    Route::post('/usuarios', [UsuarioController::class, 'store'])
        ->name('usuarios.store');
    Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/{id}', [UsuarioController::class, 'show'])->name('usuarios.show');
    Route::get('/usuarios/{id}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
});

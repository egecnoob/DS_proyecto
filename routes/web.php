<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TPacienteController;
use App\Http\Controllers\TCitaController;
use App\Http\Controllers\TTratamientoController;
use App\Http\Controllers\TAnalisisController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// PACIENTES
Route::get('/pacientes', [TPacienteController::class, "index"])->name("pacientes.index");

// agregar P
Route::post('/pacientes/agregar_paciente', [TPacienteController::class, "create"])->name("paciente.create");

// actualizar P
Route::post('/pacientes/actualizar_paciente', [TPacienteController::class, "update"])->name("paciente.update");

// eliminar P
Route::get('/pacientes/eliminar_paciente-{id}', [TPacienteController::class, "delete"])->name("paciente.delete");



// Citas
Route::get('/citas', [TCitaController::class, "index"])->name("citas.index");

// agregar C
Route::post('/citas/agregar_citas', [TCitaController::class, "create"])->name("cita.create");

// actualizar C
Route::post('/citas/actualizar_citas', [TCitaController::class, "update"])->name("cita.update");

// eliminar C
Route::get('/citas/eliminar_citas-{id}', [TCitaController::class, "delete"])->name("cita.delete");



// Analisis
Route::get('/analisis', [TAnalisisController::class, "index"])->name("analisis.index");

// agregar A
Route::post('/analisis/agregar_analisis', [TAnalisisController::class, "create"])->name("analisis.create");

// actualizar A
Route::post('/analisis/actualizar_analisis', [TAnalisisController::class, "update"])->name("analisis.update");

// eliminar A
Route::get('/analisis/eliminar_analisis-{id}', [TAnalisisController::class, "delete"])->name("analisis.delete");


// Tratamientos
Route::get('/tratamientos', [TTratamientoController::class, "index"])->name("tratamientos.index");

// agregar T
Route::post('/tratamientos/agregar_tratamientos', [TTratamientoController::class, "create"])->name("tratamiento.create");

// actualizar T
Route::post('/tratamientos/actualizar_tratamientos', [TTratamientoController::class, "update"])->name("tratamiento.update");

// eliminar T
Route::get('/tratamientos/eliminar_tratamientos-{id}', [TTratamientoController::class, "delete"])->name("tratamiento.delete");


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

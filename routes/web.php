<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TPacienteController;
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

// agregar
Route::post('/pacientes/agregar_paciente', [TPacienteController::class, "create"])->name("paciente.create");

// actualizar
Route::post('/pacientes/actualizar_paciente', [TPacienteController::class, "update"])->name("paciente.update");

// eliminar
Route::get('/pacientes/eliminar_paciente-{id}', [TPacienteController::class, "delete"])->name("paciente.delete");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

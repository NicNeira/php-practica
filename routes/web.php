<?php

use App\Http\Controllers\CreateController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\GetbyIdController;
use App\Http\Controllers\GetController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// HOME
Route::get('/', function () {
  return view('landing.index');
})->name('raiz');

// User routes
Route::get('/login', [UserController::class, 'formularioLogin'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('usuario.validar');

Route::post('/logout', [UserController::class, 'logout'])->name('usuario.logout');

Route::get('/users/register', [UserController::class, 'formularioNuevo'])->name('usuario.registrar');
Route::post('/users/register', [UserController::class, 'registrar'])->name('usuario.registrar');

// Protegiendo las rutas con el middleware de autenticación
Route::middleware(['auth'])->group(function () {

  Route::get('/user', function () {
    $user = Auth::user();
    return view('usuario.info', ['user' => $user]);
  })->name('usuario.info');

  Route::get('/proyects', [GetController::class, '__invoke'])->name('proyects.home');
  Route::get('/get', GetController::class);
  Route::get('/create', CreateController::class)->name('proyect.create');
  Route::post('/create', [CreateController::class, 'store']);
  Route::get('/getbyid/{Id}', GetbyIdController::class);
  Route::delete('/proyects/{id}', [DeleteController::class, 'destroy'])->name('proyect.destroy');
  Route::get('/proyects/{id}/edit', [UpdateController::class, '__invoke'])->name('proyect.edit');
  Route::post('/proyects/{id}/update', [UpdateController::class, 'update'])->name('proyect.update');
});

<?php


use App\Http\Controllers\GetController;
use App\Http\Controllers\ProyectController;
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

  Route::get('/proyects', [GetController::class, '__invoke'])->name('proyects.index');
  Route::get('/proyects-config', [ProyectController::class, 'index'])->name('proyects.list');

  Route::post('/proyects', [ProyectController::class, 'store'])->name('proyects.store');
  Route::get('/proyects/create', [ProyectController::class, 'create'])->name('proyects.create');

  Route::get('/proyects/{Id}', [ProyectController::class, 'show'])->name('proyects.show');
  Route::get('/proyects/{Id}/edit', [ProyectController::class, 'edit'])->name('proyects.edit');
  // Aquí añado la ruta PUT para actualizar
  Route::put('/proyects/{Id}', [ProyectController::class, 'update'])->name('proyects.update');

  Route::post('/proyects/{Id}/toggle-status', [ProyectController::class, 'toggleStatus']);
  Route::delete('/proyects/{Id}', [ProyectController::class, 'destroy']);

  // con backoffice
  // Route::get('/backoffice/users', [UserController::class, 'index'])->name('usuarios.index');
  // Route::get('/backoffice/users/get/{_id}', [UserController::class, 'getById']);
  // Route::post('/backoffice/users/new', [UserController::class, 'create'])->name('usuarios.create');
  // Route::post('/backoffice/users/down/{_id}', [UserController::class, 'disable'])->name('usuarios.disable');
  // Route::post('/backoffice/users/up/{_id}', [UserController::class, 'enable'])->name('usuarios.enable');
  // Route::post('/backoffice/users/update/{_id}', [UserController::class, 'update'])->name('usuarios.update');
  // Route::post('/backoffice/users/delete/{_id}', [UserController::class, 'delete'])->name('usuarios.delete');
});

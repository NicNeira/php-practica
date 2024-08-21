<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
  public function formularioLogin()
  {
    if (Auth::check()) {
      return redirect()->route('usuario.info');
    }
    return view('usuario.login');
  }

  public function formularioNuevo()
  {
    if (Auth::check()) {
      return redirect()->route('usuario.info');
    }
    return view('usuario.create');
  }

  public function login(Request $_request)
  {
    $mensajes = [
      'email.required' => 'El email es obligatorio',
      'email.email' => 'El email no es válido',
      'password.required' => 'La contraseña es obligatoria',
    ];

    $_request->validate([
      'email' => 'required|email',
      'password' => 'required',
    ], $mensajes);

    $credenciales = $_request->only('email', 'password');

    if (Auth::attempt($credenciales)) {
      $user = Auth::user();
      if (!$user->activo) {
        Auth::logout();
        return redirect()->route('login')->withErrors(['email' => 'El usuario se encuentra desactivado, por favor contacte al administrador']);
      }
      $_request->session()->regenerate();
      return redirect()->route('usuario.info');
    }
    return redirect()->back()->withErrors(['email' => 'El usuario o contraseña son incorrectos']);
  }

  public function logout(Request $_request)
  {
    Auth::logout();
    $_request->session()->invalidate();
    $_request->session()->regenerateToken();
    return redirect()->route('raiz');
  }

  public function registrar(Request $_request)
  {
    $mensajes = [
      'nombre.required' => 'El nombre es obligatorio',
      'email.required' => 'El correo es obligatorio',
      'email.email' => 'El correo no es válido',
      'password.required' => 'La contraseña es obligatoria',
      'rePassword.required' => 'Repetir la contraseña es obligatorio',
      'dayCode.required' => 'El codigo del dia es obligatorio',

    ];

    $_request->validate([
      'nombre' => 'required|string|max:50',
      'email' => 'required|email|max:100',
      'password' => 'required',
      'rePassword' => 'required',
      'dayCode' => 'required',
    ], $mensajes);

    $datos = $_request->only('nombre', 'email', 'password', 'rePassword', 'dayCode');

    if ($datos['password'] != $datos['rePassword']) {
      return back()->withErrors(['message' => 'Las contraseñas ingresas no son iguales']);
    }

    //Codigo del dia
    date_default_timezone_set('America/Santiago');

    if ($datos['dayCode'] != date("d")) {
      return back()->withErrors(['message' => 'El codigo del dia no es correcto']);
    }

    try {
      User::create([
        'nombre' => $datos['nombre'],
        'email' => $datos['email'],
        'password' => Hash::make($datos['password'])
      ]);
      return redirect()->route('login')->with('success', 'Usuario creado exitosamente :)');
    } catch (QueryException $e) {
      if ($e->getCode() == 23000) {
        return back()->withErrors(['message' => 'Error: El correo ya se encuentra registrado']);
      }
      return back()->withErrors(['message' => 'Error: ' . $e->getMessage()]);
    }
  }
}

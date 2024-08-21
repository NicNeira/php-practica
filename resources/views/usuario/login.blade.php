@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="w-50">
    <h1 class="text-center">Iniciar sesión</h1>
    <!-- Errores  -->
    @if ($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ Route('usuario.validar') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Ingresa tu correo electronico.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="w-full d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
    <hr>
    <p class="text-center"> Si no tiene una cuenta, entonces <a href="{{ Route('usuario.registrar') }}">Registrarse</a></p>
</div>
@endsection
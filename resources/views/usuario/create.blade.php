@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="w-50">

    <h1 class="text-center">Crear Usuario</h1>
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
    <form action="{{ Route('usuario.registrar') }}" method="post">
        @csrf
        @method('POST')
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">Ingresa tu correo electronico.</div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <label for="rePassword" class="form-label">Repetir Contraseña</label>
            <input type="password" class="form-control" id="rePassword" name="rePassword">
        </div>
        <div id="rePasswordHelp" class="form-text">Confirme su contraseña</div> <br>

        <div class="mb-3">
            <label for="dayCode" class="form-label">Código del Día:</label>
            <input type="text" class="form-control" id="dayCode" name="dayCode">
        </div>
        <p>El codigo del dia es: <span class="fw-bold"><?php echo date("d"); ?></span></p>
        <div class="w-full d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Login</button>
        </div>
    </form>
    <hr>
    <p class="text-center">
        Si usted tiene una cuenta, entonces <a href="/login">Inicie sesión</a>
    </p>
</div>


@endsection
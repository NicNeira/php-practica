@extends('layouts.app')

@section('title', 'Landing Page')

@section('content')
<div>
  <h1>Landing Page</h1>
  <p>Esta es la página de inicio de la aplicación.</p>
  <p>Para acceder a la aplicación, por favor, inicie sesión.</p>
  <a href="/login">Iniciar sesión</a>
  @endsection
</div>
@extends('layouts.app')

@section('title', 'Landing Page')

@section('content')
<div>
  <h1>Dashboard del backoffice</h1>
  <p>Bienvenido al dashboard del backoffice.</p>
  <p>Usted ha iniciado sesión correctamente.</p>
  <hr>
  <p>Nombre : <span class="fw-bold">{{$user->nombre}}</span></p>
  <p>Email : <span class="fw-bold">{{$user->email}}</span></p>
  <hr>
</div>
@endsection
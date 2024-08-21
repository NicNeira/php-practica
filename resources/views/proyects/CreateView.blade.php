@extends('layouts.app')

@section('title', 'Crear Proyecto')

@section('content')
<div class="w-50">

    <h1>Crear Proyecto</h1>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ Route('proyect.create') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}">
        </div>
        <div class="mb-3">
            <label for="fechainicio" class="form-label">Fecha de Inicio:</label>
            <input type="date" class="form-control" id="fechainicio" name="fechainicio" value="{{ old('fechainicio') }}">
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado:</label>
            <select class="form-select" aria-label="Default select example" id="estado" name="estado">
                <option value="1">Activo</option>
                <option value="2">Inactivo</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="responsable" class="form-label">Responsable:</label>
            <input type="text" class="form-control" id="responsable" name="responsable" value="{{ old('responsable') }}">
        </div>
        <div class="mb-3">
            <label for="monto" class="form-label">Monto:</label>
            <input type="number" class="form-control" id="monto" name="monto" step="0.01" value="{{ old('monto') }}">
        </div>

        <div class="w-full d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Crear Proyecto</button>
        </div>
    </form>
</div>

@endsection
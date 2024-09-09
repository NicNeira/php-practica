@extends('layouts.app')

@section('title', 'Editar Proyecto')

@section('content')
<div class="w-50">
    <h1>Editar Proyecto</h1>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{ route('proyect.update', $proyect->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $proyect->nombre) }}">
        </div>
        <div class="mb-3">
            <label for="fechainicio" class="form-label">Fecha de Inicio:</label>
            <input type="date" class="form-control" id="fechainicio" name="fechainicio" value="{{ old('fechainicio', $proyect->fechainicio->format('Y-m-d')) }}">
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado:</label>
            <select class="form-select" aria-label="Default select example" id="estado" name="estado">
                <option value="1" {{ $proyect->estado == 1 ? 'selected' : '' }}>Activo</option>
                <option value="2" {{ $proyect->estado == 2 ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="responsable" class="form-label">Responsable:</label>
            <input type="text" class="form-control" id="responsable" name="responsable" value="{{ old('responsable', $proyect->responsable) }}">
        </div>
        <div class="mb-3">
            <label for="monto" class="form-label">Monto:</label>
            <input type="number" class="form-control" id="monto" name="monto" step="0.01" value="{{ old('monto', $proyect->monto) }}">
        </div>

        <div class="w-full d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Actualizar Proyecto</button>
        </div>
    </form>
</div>
@endsection
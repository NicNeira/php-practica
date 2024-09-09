@extends('layouts.app')

@section('title', 'Landing Page')

@section('content')
<div class="d-flex gap-3">
    @foreach($proyectos as $proyecto)
    <div class="card" style="width: 18rem;">
        @if($proyecto->imagen)
        <img src="{{ asset('storage/' . $proyecto->imagen) }}" alt="Imagen del proyecto" style="width: 50px; height: auto;">
        @else
        Sin imagen
        @endif <div class="card-body">
            <h5 class="card-title">{{ $proyecto->nombre }}</h5>
            <p class="card-text">{{ $proyecto->descripcion }}</p>
            <span class="badge bg-{{ $proyecto->activo ? 'success' : 'danger' }}">
                {{ $proyecto->active ? 'Activo' : 'Inactivo' }}
            </span>
        </div>
    </div>
    @endforeach
</div>
@endsection
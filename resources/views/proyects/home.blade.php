@extends('layouts.app')

@section('title', 'Landing Page')

@section('content')
<div class="">

    <h1>Lista de Proyectos</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <a class="btn btn-primary" role="button" href="{{ url('/create') }}">Crear Nuevo Proyecto</a>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Fecha de Inicio</th>
                <th scope="col">Estado</th>
                <th scope="col">Responsable</th>
                <th scope="col">Monto</th>
                <th scope="col">Creado por</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($proyectos as $proyecto)
            <tr>
                <td>{{ $proyecto['id'] }}</td>
                <td>{{ $proyecto['nombre'] }}</td>
                <td>{{ \Carbon\Carbon::parse($proyecto->fechainicio)->format('d-m-Y') }}</td>
                <td>{{ $proyecto['estado'] }}</td>
                <td>{{ $proyecto['responsable'] }}</td>
                <td>{{ $proyecto['monto'] }}</td>
                <td>{{ $proyecto['created_by'] }}</td>
                <td class="d-flex flex-row gap-3">
                    <a href="{{ url('/getbyid/' . $proyecto['id']) }}">Ver</a>
                    <a href="{{ url('/proyects/' . $proyecto['id']) .'/edit' }}">Editar</a>
                    <form action="{{ route('proyect.destroy', $proyecto['id']) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este proyecto?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7">No hay proyectos para mostrar.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <br>

    <!-- Componente de UF -->
    <x-indicadores />
</div>

@endsection
@extends('layouts.app')

@section('title', 'Landing Page')

@section('content')

<div>

    <h1>Lista de Proyectos</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <a href="{{ url('/create') }}">Crear Nuevo Proyecto</a>
    <p>En Dashboard</p>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Fecha de Inicio</th>
                <th>Estado</th>
                <th>Responsable</th>
                <th>Monto</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse($proyectos as $proyecto)
            <tr>
                <td>{{ $proyecto['id'] }}</td>
                <td>{{ $proyecto['nombre'] }}</td>
                <td>{{ $proyecto['fecha_inicio'] }}</td>
                <td>{{ $proyecto['estado'] }}</td>
                <td>{{ $proyecto['responsable'] }}</td>
                <td>{{ $proyecto['monto'] }}</td>
                <td>
                    <a href="{{ url('/getbyid/' . $proyecto['id']) }}">Ver</a>
                    <a href="{{ url('/update/' . $proyecto['id']).'/edit' }}">Editar</a>
                    <form action="{{ url('/delete/' . $proyecto['id']) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
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
</div>

@endsection
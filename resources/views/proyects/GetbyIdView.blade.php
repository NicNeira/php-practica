@extends('layouts.app')

@section('title', 'Landing Page')

@section('content')
<div>
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
            @if($proyectobyid)
            <tr>
                <td>{{ $proyectobyid['id'] }}</td>
                <td>{{ $proyectobyid['nombre'] }}</td>
                <td>{{ $proyectobyid['fecha_inicio'] }}</td>
                <td>{{ $proyectobyid['estado'] }}</td>
                <td>{{ $proyectobyid['responsable'] }}</td>
                <td>{{ $proyectobyid['monto'] }}</td>
                <td>
                    <a href="{{ url('/getbyid/' . $proyectobyid['id']) }}">Ver</a>
                    <a href="{{ url('/update/' . $proyectobyid['id']) }}">Editar</a>
                    <form action="{{ url('/delete/' . $proyectobyid['id']) }}" style="display:inline;">
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
            @else
            <tr>
                <td colspan="7">No hay proyectos para mostrar.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
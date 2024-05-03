<!-- resources/views/detalles-registro.blade.php -->

@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Detalles del Registro para {{ $usuario->name }}</h2>
        <hr>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Registros Detallados</h3>
            </div>
            <div class="card-body">
                @if (session('registros'))
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Acción</th>
                                <th>Tema</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (session('registros') as $registro)
                                <tr>
                                    <td>{{ $registro['fecha'] }}</td>
                                    <td>{{ $registro['hora'] }}</td>
                                    <td>{{ $registro['accion'] }}</td>
                                    <td>{{ $registro['tema'] ?? 'Ningún tema asignado' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No hay registros detallados disponibles.</p>
                @endif
            </div>
        </div>
    </div>
@endsection

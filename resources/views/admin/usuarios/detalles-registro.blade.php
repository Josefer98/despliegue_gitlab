@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1>Detalles de Registro</h1>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detalles de Registro de Estudiante: {{ $estudiante->name }}</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Fecha de Asignación</th>
                                <th>Fecha de Desasignación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $estudiante->fecha_asignacion ?? 'No asignado' }}</td>
                                <td>{{ $estudiante->fecha_desasignacion ?? 'No desasignado' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

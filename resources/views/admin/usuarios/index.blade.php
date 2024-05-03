@extends('layouts.admin')

@section('content')
    <div class="row">
        <h1>Listados de Estudiantes</h1>
    </div>
    <hr>
    <div class="row">

        <section class="content">
            <br>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Datos registrados</h3>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="ml-auto">
                            <a class="btn btn-primary" href="{{ url('/usuarios/create') }}">Agregar Nuevo Usuario <i
                                    class="fas fa-user-plus ml-2"></i></a>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <table class="table table-striped table-bordered" style="border-color: rgba(169,169,169,0.5);">
                        <thead>
                            <tr>
                                <th style="width: 5%">
                                    ID
                                </th>
                                <th style="width: 15%">
                                    Nombre Completo
                                </th>
                                <th style="width: 20%">
                                    Correo
                                </th>
                                <th style="width: 10%">
                                    Acciones
                                </th>
                                <th style="width: 20%">
                                    Tema de Grado
                                </th>
                                <th style="width: 15%">
                                    Asignaciones
                                </th>
                                <th style="width: 15%">
                                    Detalles Registro
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->id }}</td>
                                    <td>{{ $usuario->name }}</td>
                                    <td>{{ $usuario->email }}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ route('usuarios.edit', $usuario->id) }}"
                                                class="btn btn-info btn-sm">
                                                <i class="fas fa-pencil-alt"></i> Edit
                                            </a>
                                            <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST"
                                                onsubmit="return confirm('¿Estás seguro de que quieres eliminar este usuario?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>{{ $usuario->tema_asignado ?? 'Ningún tema asignado' }}</td>

                                    <td>
                                        <!-- Botones para asignar, desasignar -->
                                        <a href="{{ route('asignar-tema', $usuario->id) }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-plus"></i> Asignar Tema
                                        </a>
                                        <a href="{{ route('desasignar.tema', $usuario->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-minus"></i> Desasignar Tema
                                        </a>
                                    </td>
                                    <td>
                                        <!-- Botón para detalles -->
                                        <a href="{{ route('detalles.registro', $usuario->id) }}"
                                            class="btn btn-primary btn-sm">
                                            <i class="fas fa-eye"></i> Detalles
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </section>

    </div>
@endsection

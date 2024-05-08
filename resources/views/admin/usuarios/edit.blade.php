@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Editar Estudiante</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('usuarios.update', $estudiante->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $estudiante->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $estudiante->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="curso" class="form-label">Curso</label>
                            <input type="number" class="form-control" id="curso" name="curso" value="{{ $estudiante->curso }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="cu" class="form-label">Carnet Universitario</label>
                            <input type="text" class="form-control" id="cu" name="cu" value="{{ $estudiante->cu }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        <a href="/usuarios" class="btn btn-danger">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Nuevo Estudiante
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('usuarios.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="curso" class="form-label">Curso</label>
                            <input type="number" class="form-control" id="curso" name="curso" min="1" max="9" required>
                        </div>
                        <div class="mb-3">
                            <label for="cu" class="form-label">Carnet Universitario</label>
                            <input type="text" class="form-control" id="cu" name="cu" pattern="\d{3}-\d{2}" title="El formato debe ser XXX-XX (por ejemplo, 111-01)" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Crear Estudiante</button>
                        <a href="/usuarios" class="btn btn-danger">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

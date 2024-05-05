@extends('layouts.admin')

@section('content')
    <h2>Asignar Tema de Grado a {{ $usuario->name }}</h2>
    <form action="{{ route('usuarios.asignar-tema-action', $usuario->id) }}" method="POST">
        @csrf
        <select name="tema" id="tema" class="form-control">
            <option value="" selected disabled>Seleccionar Tema de Grado</option>
            @foreach ($temasDisponibles as $tema)
                <option value="{{ $tema }}">{{ $tema }}</option>
            @endforeach
        </select>
        <button type="submit" class="btn btn-primary mt-2">Asignar Tema</button>
    </form>
@endsection
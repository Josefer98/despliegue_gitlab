@extends('layouts.admin')


@section('content')
    <div class="row">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Editar Docentes</h3>
            </div>


            <form method="POST" action="{{route('docente.update',$docente->id_docente)}}"  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="nombre">Nombres</label>
                        <input type="text" name="nombre" class="form-control" id="nombre" value="{{old('nombre', $docente->nombre)}}">
                        
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" name="apellidos" class="form-control" id="apellidos" value="{{old('apellidos', $docente->apellidos)}}">
                        
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" class="form-control" id="email" value="{{old('email', $docente->email)}}">
                        
                    </div>
                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="text" name="telefono" class="form-control" id="telefono" value="{{old('telefono', $docente->telefono)}}">
                        
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Rol</label>
                                <select class="form-control" name="rol">
                                    <option value="tutor" {{ $docente->rol == 'tutor' ? 'selected' : '' }}>asesor</option>
                                    <option value="asesor" {{ $docente->rol == 'asesor' ? 'selected' : '' }}>tutor</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                    <a href="{{route('docente.index')}}" class="btn btn-default float-right">Cancel</a>
                </div>
            </form>
        </div>


    </div>
@endsection

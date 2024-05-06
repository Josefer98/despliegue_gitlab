@extends('layouts.admin')


@section('content')
    <div class="row">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Registrar Docentes</h3>
            </div>


            <form method="POST" action="{{route('docente.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="nombre">Nombres</label>
                        <input type="text" name="nombre" class="form-control" id="nombre" placeholder="nombre">
                        
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input type="text" name="apellidos" class="form-control" id="apellidos" placeholder="apellidos">
                    </div>
                    <div class="form-group">
                        <label for="email">email</label>
                        <input type="text" name="email" class="form-control" id="email" placeholder="email">
                    </div>
                    <div class="form-group">
                        <label for="telefono">telefono</label>
                        <input type="text" name="telefono" class="form-control" id="telefono" placeholder="telefono">
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>rol</label>
                                <select class="form-control" name="rol">
                                    <option value="tutor" selected>tutor</option>
                                    <option value="asesor">asesor</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                    <a href="{{route('docente.index')}}" class="btn btn-default float-right">Cancel</a>
                </div>
            </form>
        </div>


    </div>
@endsection

@extends('layouts.admin')


@section('content')
    <div class="row">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Registrar Tema</h3>
            </div>


            <form method="POST" action="{{route('temas.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="titulo">Titulo</label>
                        <input type="text" name="titulo" class="form-control" id="titulo" placeholder="Titulo...">
                        
                    </div>
                    <div class="form-group">
                        <label for="palabras_clave">Palabras clave</label>
                        <input type="text" name="palabras_clave" class="form-control" id="palabras_clave" placeholder="palabra1, palabra2,....">
                    </div>
                    <div class="row">
                        <div class="col-sm-6">

                            <div class="form-group">
                                <label for="docente_id">Tutor</label>
                                <select class="form-control" name="docente_id">
                                <option value="" selected disabled>--Seleccione tutor--</option>
                                    @foreach ($docentesTutor as $docente)
                                        <option value="{{ $docente->id_docente }}">{{ $docente->nombre }} {{ $docente->apellidos }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Estado</label>
                                <select class="form-control" name="estado">
                                    <option value="libre" selected>Libre</option>
                                    <option value="asignado">Asignado</option>
                                    <option value="terminado">Terminado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" name="descripcion" rows="3" placeholder="Descripcion ..."></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Subir PDF</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="pdfFile" name="pdfFile" onchange="updateFileName(this)">
                                <label class="custom-file-label" for="pdfFile">Elegir archivo</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                    <a href="{{route('temas.index')}}" class="btn btn-default float-right">Cancel</a>
                </div>
            </form>
        </div>


    </div>
@endsection

<script>
    function updateFileName(input) {
        var fileName = input.files[0].name;
        var label = input.nextElementSibling;
        label.innerText = fileName;
    }
</script>

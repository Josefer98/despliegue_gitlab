@extends('layouts.admin')


@section('content')
    <div class="row">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Editar Tema</h3>
            </div>


            <form method="POST" action="{{route('temas.update',$tema->id_tema)}}"  enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="titulo">Titulo</label>
                        <input type="text" name="titulo" class="form-control" id="titulo" value="{{old('titulo', $tema->titulo)}}">
                        
                    </div>
                    <div class="form-group">
                        <label for="palabras_clave">Palabras clave</label>
                        <input type="text" name="palabras_clave" class="form-control" id="palabras_clave" value="{{old('palabras_clave', $tema->palabras_clave)}}">
                    </div>
                    <div class="row">
                        <div class="col-sm-6">

                            <div class="form-group">
                                <label for="docente_id">Tutor</label>
                                <select class="form-control" name="docente_id">
                                    @foreach ($docentesTutor as $docente)
                                        <option value="{{ $docente->id_docente }}" {{ $tema->docente_id == $docente->id ? 'selected' : '' }}>{{ $docente->nombre }} {{ $docente->apellidos }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Estado</label>
                                <select class="form-control" name="estado">
                                    <option value="libre" {{ $tema->estado == 'libre' ? 'selected' : '' }}>Libre</option>
                                    <option value="asignado" {{ $tema->estado == 'asignado' ? 'selected' : '' }}>Asignado</option>
                                    <option value="terminado" {{ $tema->estado == 'terminado' ? 'selected' : '' }}>Terminado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">

                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" name="descripcion" rows="3">{{ old('descripcion', $tema->descripcion) }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Subir PDF</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="pdfFile" name="pdfFile" onchange="updateFileName(this)">
                                <label class="custom-file-label" for="pdfFile">{{old('pdf_file', $tema->pdf_file)}}</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Actualizar</button>
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

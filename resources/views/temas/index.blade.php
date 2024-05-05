@extends('layouts.admin')


@section('content')
<div class="row">
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title">Temas de Grado</h3>
                <div class="card-tools">
                    <a href="{{route('temas.create')}}" type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Agregar Tema</a>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>Tutor</th>
                                <th>Estado</th>
                                <th>descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($temas as $tema)
                                <tr>
                                    <td>{{$tema -> titulo}}</td>
                                    <td>{{ $tema->docente->nombre }} {{ $tema->docente->apellidos }}</td>
                                    <td>
                                        @if ($tema->estado == 'libre')
                                            <span class="badge badge-success">Libre</span>
                                        @elseif ($tema->estado == 'asignado')
                                            <span class="badge badge-danger">Asignado</span>
                                        @endif
                                    </td>
                                    <td>{{$tema -> descripcion}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ asset($tema->pdf_file) }}" target="_blank" class="btn btn-primary">PDF</a>
                                            <a href="{{route('temas.edit',$tema->id_tema)}}" class="btn btn-success">Editar</a>
                                            <button type="button" onclick="confirmDelete('{{$tema->id_tema}}')" class="btn btn-danger">Eliminar</button>
                                            
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="card-footer clearfix">
                <!-- <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a> -->
                <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-right">Ver todos</a>
            </div>

        </div>
    </div>
@endsection

<script>
    function confirmDelete(id){
        var res = window.confirm('Seguro que quiere eliminar el tema');
        if(res){
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = `/temas/${id}`;
            form.innerHTML = '@csrf @method("DELETE")';
            document.body.appendChild(form);
            form.submit();
        } else {
            return false;
        }
    }
</script>
@extends('layouts.admin')


@section('content')
<div class="row">
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title">Docentes</h3>
                <div class="card-tools">
                    <a href="{{route('docente.create')}}" type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Agregar docente</a>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>email</th>
                                <th>telefono</th>
                                <th>rol</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($docente as $docentes)
                                <tr>
                                    <td>{{$docentes -> nombre}}</td>
                                    <td>{{$docentes -> apellidos}}</td>
                                    <td>{{$docentes -> email}}</td>
                                    <td>{{$docentes -> telefono}}</td>
                                    <td>
                                        @if ($docentes->rol == 'tutor')
                                            <span class="badge badge-success">tutor</span>
                                        @elseif ($docentes->rol == 'asesor')
                                            <span class="badge badge-danger">asesor</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('docente.edit',$docentes->id_docente)}}" class="btn btn-success">Editar</a>
                                            <button type="button" onclick="confirmDelete('{{$docentes->id_docente}}')" class="btn btn-danger">Eliminar</button>
                                            
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
        var res = window.confirm('Seguro que quiere eliminar el docente');
        if(res){
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = `/docente/${id}`;
            form.innerHTML = '@csrf @method("DELETE")';
            document.body.appendChild(form);
            form.submit();
        } else {
            return false;
        }
    }
</script>
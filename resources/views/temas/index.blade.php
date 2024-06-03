@extends('layouts.admin')


@section('content')
<div class="row">
    <div class="row">
        <div class="">
        <form id="searchForm" action="{{ route('temas.index') }}" method="GET">
            <div style="display: flex; justify-content: space-between;">
                <div class="btn-group">
                    <button type="button" class="btn btn-info">Filtrar</button>
                    <button type="button" class="btn btn-info" data-toggle="dropdown" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span><img src="{{ asset('dist/img/icons/filter.png') }}" alt="Ícono 1">
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                        <a class="dropdown-item filter-item" href="#" data-value="libre">Temas libre</a>
                        <a class="dropdown-item filter-item" href="#" data-value="asignado">Temas asignados</a>
                        <a class="dropdown-item filter-item" href="#" data-value="">Todos</a>
                    </div>
                </div>
                <div class="input-group">
                    <input type="search" class="form-control form-control-lg" id="searchInput" name="busqueda" placeholder="Buscar temas...">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-lg btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    </div>
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
                                        @elseif ($tema->estado == 'terminado')
                                            <span class="badge badge-danger">Terminado</span>
                                        @endif
                                    </td>
                                    <td>{{$tema -> descripcion}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ asset($tema->pdf_file) }}" target="_blank" class="btn btn-default"><img src="{{ asset('dist/img/icons/pdf.png') }}" alt="Ícono 1"></a>
                                            <a href="{{route('temas.edit',$tema->id_tema)}}" class="btn btn-default"><img src="{{ asset('dist/img/icons/editar.png') }}" alt="Ícono 2"></a>
                                            <button type="button" onclick="confirmDelete('{{$tema->id_tema}}')" class="btn btn-default"><img src="{{ asset('dist/img/icons/borrar.png') }}" alt="Ícono 3"></button>
                                            
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
                <a href="{{ route('temas.index') }}" class="btn btn-sm btn-secondary float-right">Ver todos</a>
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

    document.addEventListener('DOMContentLoaded', function() {
        const filterItems = document.querySelectorAll('.filter-item');
        filterItems.forEach(function(item) {
            item.addEventListener('mousedown', function(event) {
                event.preventDefault();
                const filterValue = this.getAttribute('data-value');
                document.getElementById('searchInput').value = filterValue;
                document.getElementById('searchForm').submit();
            });
        });
    });
</script>
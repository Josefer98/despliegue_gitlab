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
                                <span class="sr-only">Toggle Dropdown</span><img
                                    src="{{ asset('dist/img/icons/filter.png') }}" alt="Ícono 1">
                            </button>
                            <div class="dropdown-menu" role="menu" style="">
                                <a class="dropdown-item filter-item" href="#" data-value="libre">Temas libre</a>
                                <a class="dropdown-item filter-item" href="#" data-value="asignado">Temas
                                    asignados</a>
                                <a class="dropdown-item filter-item" href="#" data-value="">Todos</a>
                            </div>
                        </div>
                        <div class="input-group">
                            <input type="search" class="form-control form-control-lg" id="searchInput" name="busqueda"
                                placeholder="Buscar temas...">
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
                    <a href="{{ route('temas.create') }}" type="button" class="btn btn-primary float-right"><i
                            class="fas fa-plus"></i> Agregar Tema</a>
                </div>
            </div>
            
            <div class="row">
                @foreach ($temas as $tema)
                    @if ($tema->area == "Ciencias de la Computación")
                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-info">
                            <div class="inner" style="min-height: 200px">
                                <h1 style="font-size: 25px">{{$tema->titulo}}</h1>
                                <p style="padding-top: 10px">Carrera: {{$tema->area}}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{ route('temas.informacion',$tema->id_tema) }}" class="small-box-footer">Más información<i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    @elseif ($tema->area == "Sistemas")
                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-success">
                            <div class="inner" style="min-height: 200px">
                                <h1 style="font-size: 25px">{{$tema->titulo}}</sup></h1>
                                <p style="padding-top: 10px">Carrera: {{$tema->area}}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('temas.informacion',$tema->id_tema) }}" class="small-box-footer">Más información<i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    @else
                    <div class="col-lg-3 col-6">

                        <div class="small-box bg-danger">
                            <div class="inner" style="min-height: 200px">
                                <h1 style="font-size: 25px">{{$tema->titulo}}</h1>
                                <p style="padding-top: 10px">Carrera: {{$tema->area}}</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                            <a href="{{ route('temas.informacion',$tema->id_tema) }}" class="small-box-footer">Más información<i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>

            <div class="card-footer clearfix">
                <!-- <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a> -->
                <a href="{{ route('temas.index') }}" class="btn btn-sm btn-secondary float-right">Ver todos</a>
            </div>

        </div>
    </div>
@endsection

<script>
    function confirmDelete(id) {
        var res = window.confirm('Seguro que quiere eliminar el tema');
        if (res) {
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = `/temas/${id}`;
            form.innerHTML = '@csrf @method('DELETE')';
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

@extends('layouts.admin')


@section('content')
    <div class="row">

        <div class="card">
            
            @if ($temas->area == "Ciencias de la Computación")
                <div class="card-header border-transparent" style="background-color: rgba(13,202,240,1)">
                    <h3 class="card-title" style="color: white"><b>Tema de Grado: {{$temas->titulo}}</b></h3>
                </div>
            @elseif ($temas->area == "Sistemas")
                <div class="card-header border-transparent" style="background-color: rgba(25,135, 84, 1)">
                    <h3 class="card-title"  style="color: white"><b>Tema de Grado: {{$temas->titulo}}</b></h3>
                </div>
            @else
                <div class="card-header border-transparent" style="background-color: rgba(220,53, 69, 1)">
                    <h3 class="card-title"  style="color: white"><b>Tema de Grado: {{$temas->titulo}}</b></h3>
                </div>
            @endif
            
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr>
                                <th>Tutor</th>
                                <th>Estado</th>
                                <th>descripción</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td>{{ $temas->docente->nombre }} {{ $temas->docente->apellidos }}</td>
                                    <td>
                                        @if ($temas->estado == 'libre')
                                            <span class="badge badge-success">Libre</span>
                                        @elseif ($temas->estado == 'asignado')
                                            <span class="badge badge-danger">Asignado</span>
                                        @endif
                                    </td>
                                    <td>{{ $temas->descripcion }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ asset($temas->pdf_file) }}" target="_blank"
                                                class="btn btn-default"><img src="{{ asset('dist/img/icons/pdf.png') }}"
                                                    alt="Ícono 1"></a>
                                            <a href="{{ route('temas.edit', $temas->id_tema) }}" class="btn btn-default"><img
                                                    src="{{ asset('dist/img/icons/editar.png') }}" alt="Ícono 2"></a>
                                            <button type="button" onclick="confirmDelete('{{ $temas->id_tema }}')"
                                                class="btn btn-default"><img src="{{ asset('dist/img/icons/borrar.png') }}"
                                                    alt="Ícono 3"></button>

                                        </div>
                                    </td>
                                </tr>

                        </tbody>
                    </table>
                </div>

            </div>
            <div class="card-footer clearfix">
                <!-- <a href="javascript:void(0)" class="btn btn-sm btn-info float-left">Place New Order</a> -->
                <a href="{{ route('temas.index') }}" class="btn btn-sm btn-secondary float-right">Volver</a>
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
</script>

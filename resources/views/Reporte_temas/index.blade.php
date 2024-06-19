@extends('layouts.admin')


@section('content')
<div class="row">
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title">Reporte de Temas</h3>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <h1>Registros de Acciones</h1>
                    <table>
                        <thead>
                            <tr>
                                <th>Acción</th>
                                <th>Tema</th>
                                <th>Usuario</th>
                                <th>Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($id as $log)
                                <tr>
                                    <td>{{ $log->action }}</td>
                                    <td>{{ $log->tema->name }}</td>
                                    <td>{{ $log->user ? $log->user->name : 'N/A' }}</td>
                                    <td>{{ $log->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
@endsection

<script>
    function confirmDelete(id){
        var res = window.confirm('Seguro que quiere eliminar el reporte');
        if(res){
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = `/Reporte_temas/${id}`;
            form.innerHTML = '@csrf @method("DELETE")';
            document.body.appendChild(form);
            form.submit();
        } else {
            return false;
        }
    }
</script>
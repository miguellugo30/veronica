<div class="card  card-info card-outline showEmpresas">
    <div class="card-header ui-sortable-handle" >
        <h3 class="card-title">
            <i class="far fa-credit-card"></i> Bitacora de acciones
        </h3>
        <div class="card-tools">

        </div>
    </div><!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col viewIndex table-responsive">
                <table id="tableLogs" class="display table table-bordered table-hover table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th class="buscar">Fecha</th>
                            <th class="buscar">Hora</th>
                            <th class="buscar">Nivel</th>
                            <th class="buscar" >Usuario</th>
                            <th class="buscar">Accion</th>
                            <th class="buscar">Tabla Afectada</th>
                            <th>ID</th>
                            <th>Mensaje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($logs as $log)
                            <tr data-id="{{ $log->id }}">
                                <td>{{ date( 'Y-m-d', strtotime($log->fecha) )  }}</td>
                                <td>{{ date( 'H:i:s', strtotime($log->fecha) )  }}</td>
                                <td>{{ $log->nivel }}</td>
                                <td>{{ $log->Usuarios->email }}</td>
                                <td>{{ $log->accion }}</td>
                                <td>{{ $log->tabla }}</td>
                                <td>{{ $log->id_registro }}</td>
                                <td>{{ $log->mensaje }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Nivel</th>
                            <th>Usuario</th>
                            <th>Accion</th>
                            <th>Tabla Afectada</th>
                            <th>ID</th>
                            <th>Mensaje</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div><!-- /.row -->
    </div><!-- /.card-body -->
</div>
<!-- /.card -->


<script>
$(function() {

    $('#tableLogs thead tr th.buscar').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="'+title+'" />' );
    });

    var table = $('#tableLogs').DataTable({
                    "ordering": true,
                    "searching": true,
                    "lengthChange": false,
                    "pageLength": 20,
                    'order': [
                        [0, 'asc']
                    ],
                    "columnDefs": [ {
                            "targets"  : 'no-sort',
                            "orderable": false,
                        }]
                });

    $('#tableLogs thead tr th.buscar').on( 'keyup', "input",function () {
        table
            .column( $(this).parent().index() )
            .search( this.value )
            .draw();
    } );

});
</script>


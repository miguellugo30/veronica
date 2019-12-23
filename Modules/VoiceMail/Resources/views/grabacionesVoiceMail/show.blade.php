<style>
    .dataTables_filter{
        display: none;
    }
</style>
<table id="tableInbound" class="display table table-bordered table-hover table-sm" style="width:100%">
    <thead>
        <tr>
            <th class="no-sort text-center"><input type="checkbox" class="checkall" id="checkall"/></th>
            <th class="buscar">Nombre Buzon</th>
            <th class="buscar">Numero</th>
            <th class="buscar">Fecha</th>
            <th class="buscar">Hora inicio</th>
            <th class="buscar">Hora fin</th>
            <th class="no-sort">Escuchar</th>
            <th class="no-sort">Enviar</th>
            <th class="no-sort"></th>
        </tr>
    </thead>
    <tbody>
        @foreach( $Grabaciones as $grabacion )
            <tr data-id="{{ $grabacion->id }}" style="cursor:pointer">
                <td class="justify-content-md-center text-center"><input type="checkbox" name="numcheck" value="{{ $grabacion->id }}" class="checkbox"/></td>
                <td>{{ $grabacion->buzon }}</td>
                <td>{{ $grabacion->callerid }}</td>
                <td>{{ date('d-m-Y',strtotime($grabacion->fecha_inicio)) }}</td>
                <td>{{ date('H:i:s',strtotime($grabacion->fecha_inicio)) }}</td>
                <td>{{ date('H:i:s',strtotime($grabacion->fecha_fin)) }}</td>
                <td class="text-center"><i class="fas fa-volume-up fa-lg text-primary escuchar-grabacion" id="{{ $grabacion->nombre_archivo."|".$grabacion->id }}"></i></td>
                <td class="text-center"><i class="fas fa-mail-bulk fa-lg text-primary enviar-grabacion" id="{{$grabacion->id}}"></i></td>
                <td class="text-center">
                    @if ($grabacion->estado == 1)
                        <i class="far fa-envelope fa-lg"></i>
                    @elseif( $grabacion->estado == 2 )
                        <i class="far fa-envelope-open fa-lg text-success"></i>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th></th>
            <th class="buscar">Nombre Buzon</th>
            <th>Numero</th>
            <th>Fecha</th>
            <th>Hora Inicio</th>
            <th>Hora Fin</th>
            <th>Escuchar</th>
            <th>Enviar</th>
            <th></th>
        </tr>
    </tfoot>
</table>



<script>
$(function() {

    $('#tableInbound thead tr th.buscar').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="'+title+'" />' );
    });

    var table = $('#tableInbound').DataTable({
                    "ordering": true,
                    "searching": true,
                    "lengthChange": false,
                    "pageLength": 20,
                    'order': [
                        [3, 'desc']
                    ],
                    "columnDefs": [ {
                            "targets"  : 'no-sort',
                            "orderable": false,
                        }]
                });

    $('#tableInbound thead tr th.buscar').on( 'keyup', "input",function () {
        table
            .column( $(this).parent().index() )
            .search( this.value )
            .draw();
    } );
});
</script>



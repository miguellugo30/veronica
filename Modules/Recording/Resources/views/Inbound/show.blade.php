<style>
    .dataTables_filter{
        display: none;
    }
</style>
<table id="tableInbound" class="display table table-bordered table-hover table-sm" style="width:100%">
    <thead>
        <tr>
            <th class="no-sort text-center"><input type="checkbox" class="checkall" id="checkall"/></th>
            <th class="no-sort">FTP</th>
            <th class="buscar no-sort">Campaña</th>
            <th class="buscar no-sort">Agente</th>
            <th class="buscar no-sort">Extensión</th>
            <th class="buscar no-sort">Numero</th>
            <th class="buscar no-sort">Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th >Duración</th>
            <!--th>Calificación</th>
            <th>Subcalificación</th-->
            <th class="no-sort">Escuchar</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $Grabaciones as $grabacion )
            <tr data-id="{{ $grabacion->id }}" style="cursor:pointer">
                <td class="justify-content-md-center text-center"><input type="checkbox" name="numcheck" value="{{ $grabacion->id }}" class="checkbox"/></td>
                <td class="text-center">
                    @if ( $grabacion->estado == 'Servidor' )
                        <i class="fas fa-circle text-secondary"></i>
                    @else
                        <i class="fas fa-circle text-primary"></i>
                    @endif
                </td>
                <td>{{ $grabacion->campana }}</td>
                <td>{{ $grabacion->agente }}</td>
                <td>{{ $grabacion->extension }}</td>
                <td>{{ $grabacion->numero }}</td>
                <td>{{ date('d-m-Y H:i:s',strtotime($grabacion->inicio)) }}</td>
                <td>{{ date('d-m-Y H:i:s',strtotime($grabacion->fin)) }}</td>
                <td>{{ date('H:i:s',strtotime($grabacion->duracion)) }}</td>
                <!--td></td>
                <td></td-->
                <td  class="text-center"><i class="fas fa-volume-up fa-lg text-primary escuchar-grabacion" id="{{ $grabacion->escuchar."|".$grabacion->id }}"></i></td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th></th>
            <th>FTP</th>
            <th>Campaña</th>
            <th>Agente</th>
            <th>Extensión</th>
            <th>Numero</th>
            <th>Fecha Inicio</th>
            <th>Fecha Fin</th>
            <th>Duración</th>
            <!--th>Calificación</th>
            <th>Subcalificación</th-->
            <th>Escuchar</th>
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
                        [6, 'desc']
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



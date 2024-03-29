<div class="box-body">
    <div class="row">
        <div class="col-md-12 viewIndex table-responsive" >
            <table id="tabledesglose" class="display table table-bordered table-hover table-sm" style="width:100%">
                <thead class="thead-light">
                    <tr>
                        <th class="buscar">Campaña</th>
                        <th class="buscar">Numero Origen</th>
                        <th class="buscar">Numero Destino</th>
                        <th class="buscar">Fecha</th>
                        <th>Hora Inicio</th>
                        <th>Hora Respuesta</th>
                        <th>Hora Fin</th>
                        <th>Hora Definición</th>
                        <th>Tiempo Espera</th>
                        <th>Duración</th>
                        <th>Definición</th>
                        <th class="buscar">Agente</th>
                        <th>Colgado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($desglose as $registro)
                        <tr data-id="{{ $registro->uniqueid }}" style="cursor:pointer">
                            <td>{{ Str::title( $registro->nombre_campana ) }}</td>
                            <td>{{ $registro->origen }}</td>
                            <td>{{ $registro->destino }}</td>
                            <td>{{ date('d-m-Y', strtotime($registro->hora_Inicio)) }}</td>
                            <td>{{ date('H:i:s', strtotime($registro->hora_Inicio)) }}</td>
                            <td>
                                @if($registro->hora_respuesta == null)
                                    00:00:00
                                @else
                                    {{ date('H:i:s', strtotime($registro->hora_respuesta)) }}
                                @endif
                            </td>
                            <td>{{ date('H:i:s', strtotime($registro->hora_fin)) }}</td>
                            <td>
                                @if($registro->hora_definicion == null)
                                    00:00:00
                                @else
                                    {{ date('H:i:s', strtotime($registro->hora_definicion)) }}
                                @endif
                            </td>
                            <td>
                                @if($registro->espera == null)
                                    {{ $registro->duracion }}
                                @else
                                    {{ $registro->espera }}
                                @endif
                            </td>
                            <td>{{ $registro->duracion }}</td>
                            <td>
                                @if($registro->definicion == null)
                                    00:00:00
                                @else
                                    {{ $registro->definicion }}
                                @endif
                            </td>
                            <td>{{ $registro->agente }}</td>
                            <td>
                                @if($registro->evento == 'COMPLETEAGENT')
                                    AGENTE
                                @elseif($registro->evento == 'COMPLETECALLER')
                                    CLIENTE
                                @elseif($registro->evento == 'ABANDON')
                                    ABANDONADA
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Campaña</th>
                        <th>Numero Origen</th>
                        <th>Numero Destino</th>
                        <th>Fecha</th>
                        <th>Hora Inicio</th>
                        <th>Hora Respuesta</th>
                        <th>Hora Fin</th>
                        <th>Hora Definición</th>
                        <th>Tiempo Espera</th>
                        <th>Duración</th>
                        <th>Definición</th>
                        <th>Agente</th>
                        <th>Colgado</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-12 viewCreate"></div>
    </div><!-- /.row -->
</div><!-- ./box-body -->
<script>
$(function() {

    $('#tabledesglose thead tr th.buscar').each( function () {
        var title = $(this).text();
		$(this).html( '<input type="text" placeholder="'+title+'" />' );
	});

    var table = $('#tabledesglose').DataTable({
                    "ordering": false,
                    "searching": true,
                    "lengthChange": false,
                    "pageLength": 20,
                    "responsive": true,
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
                    }
                });
    $('#tabledesglose thead tr th.buscar').on( 'keyup', "input",function () {
        table.column( $(this).parent().index() )
            .search( this.value )
            .draw();
    } );
});
</script>

<div class="box-body">
    <div class="row">
        <div class="col-md-12 viewIndex" >
            <table id="tabledesglose" class="display table table-bordered table-hover table-sm" style="width:100%">
                <thead>
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
                            <td>{{ Str::title( $registro->campana ) }}</td>
                            <td>{{ $registro->callerid }}</td>
                            <td>{{ $registro->calledid }}</td>
                            <td>{{ date('d-m-Y', strtotime($registro->fecha_inicio)) }}</td>
                            <td>{{ date('H:i:s', strtotime($registro->fecha_inicio)) }}</td>
                            <td>
                                @if($registro->fecha_respuesta == null)
                                    00:00:00
                                @else
                                    {{ date('H:i:s', strtotime($registro->fecha_respuesta)) }}
                                @endif
                            </td>
                            <td>{{ date('H:i:s', strtotime($registro->fecha_fin)) }}</td>
                            <td>
                                @if($registro->fecha_calificacion == null)
                                    00:00:00
                                @else
                                    {{ date('H:i:s', strtotime($registro->fecha_calificacion)) }}
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
                                @if($registro->event == 'COMPLETEAGENT')
                                    AGENTE
                                @elseif($registro->event == 'COMPLETECALLER')
                                    CLIENTE
                                @elseif($registro->event == 'ABANDON')
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
                    "pageLength": 20
                });
    $('#tabledesglose thead tr th.buscar').on( 'keyup', "input",function () {
       console.log(this.value, $(this).parent().index())
        table
            .column( $(this).parent().index() )
            .search( this.value )
            .draw();
    } );
});
</script>

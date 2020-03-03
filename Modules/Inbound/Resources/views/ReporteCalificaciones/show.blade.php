<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><b><i class="fas fa-chart-line"></i></i> Calificaciones</b></h3>
        <!--div class="box-tools pull-right">
            <button class='btn btn-primary btn-sm descargar-reporte' >
                <i class="fas fa-circle-notch fa-spin" style="display:none"></i>
                Descargar
            </button>
        </div-->
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col table-responsive">
                <table class="table table-bordered table-striped table-sm align-middle">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th colspan="2">Estadísticas</th>
                        </tr>
                        <tr class="text-center">
                            <th>Calificacion</th>
                            <th>Numero de llamadas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($calificaciones as $cal)
                            <tr class="text-center">
                                <th>{{ $cal->Calificacion }}</th>
                                <td>{{ $cal->Llamadas }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col align-items-center">
                <div class="col" id="container_4" style="height: 300px;"></div>
            </div>
        </div>
    </div><!-- ./box-body -->
</div>
<script>

    $(function() {
        /**
         * Grafica de calificaciones
         **/
        Highcharts.chart('container_4', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Calificaciones'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.1f} %</b>'
            },
            accessibility: {
                point: {
                    valueSuffix: '%'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'calificación',
                colorByPoint: true,
                data: [
                    @php
                        array_pop( $calificaciones );
                    @endphp
                    @foreach ($calificaciones as $cal)
                        { name: '{{$cal->Calificacion}}', y: {{ $cal->Llamadas }} },
                    @endforeach
                ]
            }]
        });

    });
</script>

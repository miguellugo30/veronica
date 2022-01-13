<div class="card card-outline card-primary">
    <div class="card-header">
        <h1 class="card-title"><b><i class="fas fa-chart-line"></i> Calificaciones</b></h1>
    </div><!--card-header-->
    <div class="card-body">
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
    </div><!--card-header-->
</div><!--card-->

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

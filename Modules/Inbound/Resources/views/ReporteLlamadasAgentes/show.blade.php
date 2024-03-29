<div class="card card-outline card-primary">
    <div class="card-header">
        <h1 class="card-title"><b><i class="fas fa-chart-line"></i></i> Llamadas recibidas por agentes</b></h1>
    </div><!--card-header-->
    <div class="card-body">
        <div class="row">
            <div class="col table-responsive">
                <table class="table table-bordered table-striped table-sm align-middle">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th colspan="2">Llamadas</th>
                        </tr>
                        <tr class="text-center">
                            <th>Agente</th>
                            <th>Numero de llamadas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($llamadas as $llam)
                            <tr class="text-center">
                                <th>{{ $llam->Agente }}</th>
                                <td>{{ $llam->Total }}</td>
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
                type: 'column'
            },
            title: {
                text: 'Llamadas recibidas por agentes'
            },
            xAxis: {
                categories: [
                    @foreach ($llamadas as $llam)
                        '{{$llam->Agente}}',
                    @endforeach
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Llamadas'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">Llamadas: </td>' +
                    '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Agentes',
                data: [
                    @foreach ($llamadas as $llam)
                        {{$llam->Total}},
                    @endforeach
                ]
            }]
        });
    });
</script>

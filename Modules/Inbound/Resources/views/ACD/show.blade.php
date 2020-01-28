<!-- Main row -->
<div class="row">
    <div class="col">
        <div class="box-primary">
            <div class="box-header">
                <i class="fas fa-bookmark"></i>
                <h3 class="box-title"> <b>GENERAL</b> </h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <table class="table table-bordered table-striped table-sm align-middle">
                            <thead class="thead-light">
                                <tr class="text-center">
                                    <th colspan="3">Estadísticas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr >
                                    <td>Todas</td>
                                    <td class="text-center">{{ $array->Todas }}</td>
                                    <td class="text-center">{{ number_format( ( ($array->Todas) * 100 ) / ( $array->Todas ), 2) }} %</td>
                                </tr>
                                <tr >
                                    <td>Contestadas</td>
                                    <td class="text-center">{{ $array->Contestadas }}</td>
                                    <td class="text-center">{{ number_format( ( $array->Contestadas * 100 ) / ( $array->Todas ), 2) }} %</td>
                                </tr>
                                <tr>
                                    <td>Abandonadas</td>
                                    <td class="text-center">{{ $array->NoContestadas }}</td>
                                    <td class="text-center">{{ number_format( ( $array->NoContestadas * 100 ) / ( $array->Todas ), 2) }} %</td>
                                </tr>
                                <tr>
                                    <td>Desviadas</td>
                                    <td class="text-center">{{ $array->Desviadas }}</td>
                                    <td class="text-center">{{ number_format( ( $array->Desviadas * 100 ) / ( $array->Todas ), 2) }} %</td>
                                </tr>
                                <tr>
                                    <td>Promedio de Espera</td>
                                    <td class="text-center">{{ $array->PromediodeLlamada }} Hrs.</td>
                                    <td class="text-center"></td>
                                </tr>
                                <tr>
                                    <td>Promedio de Llamada</td>
                                    <td class="text-center">{{ $array->PromediotiempoEspera }} Hrs.</td>
                                    <td class="text-center"></td>
                                </tr>
                                <tr>
                                    <td>Promedio de Abandono</td>
                                    <td class="text-center">{{ $array->PromedioAbandono }} Hrs.</td>
                                    <td class="text-center"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col">
                        <div id="container_1" style="height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>


    $(function() {
        Highcharts.chart('container_1', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: ''
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage:.2f}%</b>'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.2f} %'
                    }
                }
            },
            series: [{
                name: 'Llamadas',
                colorByPoint: true,
                data: [{
                    name: 'Contestadas',
                    y: {{ $array->Contestadas }},
                    sliced: true,
                    selected: true
            }, {
                name: 'Abandonadas',
                y: {{ $array->NoContestadas }}
            }, {
                name: 'Desviadas',
                y: {{ $array->Desviadas }}
            }]
        }]
    });
});
</script>

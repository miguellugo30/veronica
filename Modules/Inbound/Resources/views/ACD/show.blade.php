<!-- Main row -->
<div class="row">
    @php
        $i = 1;
    @endphp
    @foreach ($cdr as $v)
        <div class="col">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fas fa-bookmark"></i>
                    <h3 class="box-title">CAMPANA A</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col">
                            <table class="table table-bordered table-striped align-middle">
                                <thead class="thead-light">
                                    <tr class="text-center">
                                        <th colspan="3">Estadísticas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr >
                                        <td>Contestadas</td>
                                        <td class="text-center">{{ $v->var_llamadas_total }}</td>
                                        <td class="text-center">{{ number_format( ( $v->var_llamadas_total * 100 ) / ( $v->var_llamadas_total + $v->var_llamadas_total_abandonadas ), 2) }} %</td>
                                    </tr>
                                    <tr>
                                        <td>Abandonadas</td>
                                        <td class="text-center">{{ $v->var_llamadas_total_abandonadas }}</td>
                                        <td class="text-center">{{ number_format( ( $v->var_llamadas_total_abandonadas * 100 ) / ( $v->var_llamadas_total + $v->var_llamadas_total_abandonadas ), 2) }} %</td>
                                    </tr>
                                    <tr>
                                        <td>Desviadas</td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                    </tr>
                                    <tr>
                                        <td>Promedio de Espera</td>
                                        <td class="text-center">00:00:08 Hrs.</td>
                                        <td class="text-center"></td>
                                    </tr>
                                    <tr>
                                        <td>Promedio de Llamada</td>
                                        <td class="text-center">{{ gmdate( 'H:i:s', $v->var_tiempo_promedio_total_llamada ) }} Hrs.</td>
                                        <td class="text-center"></td>
                                    </tr>
                                    <tr>
                                        <td>Promedio de Abandono</td>
                                        <td class="text-center">{{ gmdate( 'H:i:s',  $v->var_tiempo_promedio_abandono ) }} Hrs.</td>
                                        <td class="text-center"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col">
                            <div id="container_{{$i}}" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @php
            $i++;
        @endphp
    @endforeach
</div>

<script>


$(function() {
    Highcharts.chart('container', {
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
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
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
            name: 'Llamadas',
            colorByPoint: true,
            data: [{
                name: 'Contestadas',
                y: 61.41,
                sliced: true,
                selected: true
            }, {
                name: 'Abandonadas',
                y: 11.84
            }, {
                name: 'Desviadas',
                y: 10.85
            }]
        }]
    });
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
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
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
            colorByPoint: true,
            data: [{
                name: 'Contestadas',
                y: 61.41,
                sliced: true,
                selected: true
            }, {
                name: 'Abandonadas',
                y: 11.84
            }, {
                name: 'Desviadas',
                y: 10.85
            }]
        }]
    });
});
</script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<!-- Main row -->
<div class="row">
    {{--@php
        $i = 1;
    @endphp
    @foreach (dd($cdr) as $v)--}}
        <div class="col">
            <div class="box-primary">
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
                                        <td>Todas</td>
                                        <td class="text-center">{{ $todas[1] }}</td>
                                        <td class="text-center">{{ number_format( ( ($todas[1]) * 100 ) / ( $todas[1] ), 2) }} %</td>
                                    </tr>
                                    <tr >
                                        <td>Contestadas</td>
                                        <td class="text-center">{{ $contestadas[1] }}</td>
                                        <td class="text-center">{{ number_format( ( $contestadas[1] * 100 ) / ( $todas[1] ), 2) }} %</td>
                                    </tr>
                                    <tr>
                                        <td>Abandonadas</td>
                                        <td class="text-center">{{ $nocontestadas[1] }}</td>
                                        <td class="text-center">{{ number_format( ( $nocontestadas[1] * 100 ) / ( $todas[1] ), 2) }} %</td>
                                    </tr>
                                    <tr>
                                        <td>Desviadas</td>
                                        <td class="text-center">{{ $desviadas[1] }}</td>
                                        <td class="text-center">{{ number_format( ( $desviadas[1] * 100 ) / ( $todas[1] ), 2) }} %</td>
                                    </tr>
                                    <tr>
                                        <td>Promedio de Espera</td>
                                        <td class="text-center">{{ $promediotiempoespera[1] }} Hrs.</td>
                                        <td class="text-center"></td>
                                    </tr>
                                    <tr>
                                        <td>Promedio de Llamada</td>
                                        <td class="text-center">{{ $promediodellamada[1] }} Hrs.</td>
                                        <td class="text-center"></td>
                                    </tr>
                                    <tr>
                                        <td>Promedio de Abandono</td>
                                        <td class="text-center">{{ $promedioabandono[1] }} Hrs.</td>
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
        {{--@php
            $i++;
        @endphp--}}
    {{--@endforeach--}}
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
                y: {{ $contestadas[1] }},
                sliced: true,
                selected: true
            }, {
                name: 'Abandonadas',
                y: {{ $nocontestadas[1] }}
            }, {
                name: 'Desviadas',
                y: {{ $desviadas[1] }}
            }]
        }]
    });
    /*Highcharts.chart('container_', {
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
    });*/
});
</script>

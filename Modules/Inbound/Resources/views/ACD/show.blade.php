<div class="card card-outline card-primary">
    <div class="card-header">
        <h1 class="card-title"><b><i class="fas fa-chart-pie"></i> Métrica ACD</b></h1>
    </div><!--card-header-->
    <div class="card-body">
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
    </div><!--card-header-->
</div><!--card-->
<script>
    $(function() {
        /**
        * Grafica CDR
        **/
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

@if ( $reportes['nivel-servicio'] == 1 )

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h1 class="card-title"><b><i class="fas fa-chart-line"></i> Nivel de servicio</b></h1>
        </div><!--card-header-->
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <table class="table table-bordered table-striped table-sm align-middle">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th colspan="5">Estadísticas</th>
                            </tr>
                            <tr class="text-center">
                                <th>Rango de Tiempo</th>
                                <th>Total de Llamadas</th>
                                <th>Total de Llamadas Correctas</th>
                                <th>Promedio en Espera</th>
                                <th>Service Level</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < count( $nivel_servicio ); $i++)
                                <tr class="text-center">
                                    <th>{{ $nivel_servicio[$i]['rango_tiempo'] }}</th>
                                    <td>{{ $nivel_servicio[$i]['Total_de_Llamadas'] }}</td>
                                    <td>{{ $nivel_servicio[$i]['Total_Llamadas_Correctas'] }}</td>
                                    <td>{{ $nivel_servicio[$i]['Promedio_en_Espera'] }}</td>
                                    <td>{{ $nivel_servicio[$i]['Service_Level'] }}</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
                <div class="col align-items-center">
                    <div class="col" id="container_2" style="height: 600px;"></div>
                </div>
            </div>
        </div><!--card-header-->
    </div><!--card-->
    <script>
        $(function() {
            /**
            * Grafica Nivel de servicio
            **/
            Highcharts.chart('container_2', {
                chart: {
                    height: 600,
                },
                title: {
                    text: 'Nivel de servicio'
                },
                yAxis: {
                    title: {
                        text: 'Porcentaje'
                    }
                },
                xAxis: {
                    title: {
                        text: 'Rango de tiempo'
                    },
                    categories: [
                        @for ($i = 0; $i < count( $nivel_servicio ); $i++)
                            '{{ $nivel_servicio[$i]["rango_tiempo"] }}',
                        @endfor
                    ]
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle'
                },
                plotOptions: {
                    series: {
                        label: {
                            connectorAllowed: false
                        }
                    }
                },
                series: [{
                    name: 'Service Level',
                    data: [
                        @for ($i = 0; $i < count( $nivel_servicio ); $i++)
                            {{ str_replace( '%', '', $nivel_servicio[$i]["Service_Level"] ) }},
                        @endfor
                    ]
                }]
            });
        });
    </script>
@endif
@if ( $reportes['tendencia'] == 1 )

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h1 class="card-title"><b><i class="fas fa-chart-line"></i></i> Tendencia de Llamadas</b></b></h1>
        </div><!--card-header-->
        <div class="card-body">
            <div class="row">
                <div class="col table-responsive">
                    <table class="table table-bordered table-striped table-sm align-middle">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th colspan="8">Estadísticas</th>
                            </tr>
                            <tr class="text-center">
                                <th>Rango de Tiempo	</th>
                                <th>Total de Llamadas</th>
                                <th>Llamadas Contestadas</th>
                                <th>Promedio Espera (HH:MM:SS)</th>
                                <th>Promedio Duración (HH:MM:SS)</th>
                                <th>Llamadas Abandonadas</th>
                                <th>Promedio Abandono (HH:MM:SS)</th>
                                <th>Llamadas Desviadas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for ($i = 0; $i < count( $datosCampana ); $i++)
                                <tr class="text-center">
                                    <th>{{ $datosCampana[$i]['Rango_de_tiempo']  }}</th>
                                    <td>{{ $datosCampana[$i]['Total_de_Llamadas'] }}</td>
                                    <td>{{ $datosCampana[$i]['Llamadas_Contestadas'] }}</td>
                                    <td>{{ $datosCampana[$i]['Promedio_en_Espera'] }}</td>
                                    <td>{{ $datosCampana[$i]['Promedio_Duracion'] }}</td>
                                    <td>{{ $datosCampana[$i]['Llamadas_Abandonadas'] }}</td>
                                    <td>{{ $datosCampana[$i]['Promedio_Abandono'] }}</td>
                                    <td>{{ $datosCampana[$i]['Llamadas_Desviadas'] }}</td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
                <div class="col align-items-center">
                    <div class="col" id="container_3" style="height: 600px;"></div>
                </div>
            </div>
        </div><!--card-header-->
    </div><!--card-->

    <script>

        $(function() {
            /**
            * Grafica Tendencia de llamada
            **/
            Highcharts.chart('container_3', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Tendencia de llamadas'
                },
                xAxis: {
                    categories: [
                        @for ($i = 0; $i < count( $datosCampana ); $i++)
                            '{{  $datosCampana[$i]["Rango_de_tiempo"] }}',
                        @endfor
                    ]
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Numero de Llamadas'
                    },
                    stackLabels: {
                        enabled: true,
                        style: {
                            fontWeight: 'bold',
                            color: ( // theme
                                Highcharts.defaultOptions.title.style &&
                                Highcharts.defaultOptions.title.style.color
                            ) || 'gray'
                        }
                    }
                },
                legend: {
                    align: 'right',
                    x: -30,
                    verticalAlign: 'top',
                    y: 25,
                    floating: true,
                    backgroundColor:
                        Highcharts.defaultOptions.legend.backgroundColor || 'white',
                    borderColor: '#CCC',
                    borderWidth: 1,
                    shadow: false
                },
                tooltip: {
                    headerFormat: '<b>{point.x}</b><br/>',
                    pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
                },
                plotOptions: {
                    column: {
                        stacking: 'normal',
                        dataLabels: {
                            enabled: true
                        }
                    }
                },
                series: [{
                            name: 'Llamadas Contestadas',
                            data: [
                                    @for ($i = 0; $i < count( $datosCampana ); $i++)
                                        {{ str_replace( '', '', $datosCampana[$i]["Llamadas_Contestadas"] ) }},
                                    @endfor
                                ]
                        }, {
                            name: 'Llamadas Abandonadas',
                            data: [
                                    @for ($i = 0; $i < count( $datosCampana ); $i++)
                                        {{ str_replace( '', '', $datosCampana[$i]["Llamadas_Abandonadas"] ) }},
                                    @endfor
                                ]
                        }, {
                            name: 'Llamadas Desviadas',
                            data: [
                                    @for ($i = 0; $i < count( $datosCampana ); $i++)
                                        {{ str_replace( '', '',  $datosCampana[$i]["Llamadas_Desviadas"] ) }},
                                    @endfor
                                ]
                        }]
            });
        });
    </script>

@endif
@if ( $reportes['calificaciones'] == 1 )

    <div class="card card-outline card-primary">
        <div class="card-header">
            <h1 class="card-title"><b><i class="fas fa-chart-line"></i></i> Calificaciones</b></h1>
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
@endif


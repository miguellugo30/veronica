<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
$(function() {
    Highcharts.chart('container', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: 'Almacenamiento Especifico'
    },
    accessibility: {
        point: {
            valueSuffix: '%'
        }
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.2f} %<br>Capacidad: {point.y:.2f} GB</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.y:.2f} GB</b>'
            }
        }
    },
    series: [{
        type: 'pie',
        name: 'Porcentaje en Disco',
        data: [
                            /* Disponible = Almacenamiento Total - Total Grabaciones */
            ['Disponible', @foreach($config_empresas as $config) {{ (($config->almacenamiento_posiciones)+($config->almacenamiento_adicional))/1024 }} @endforeach - {{ ($inbound+$outbound+$manual+$buzon+$audios)/1024 }}],
            ['Inbound', {{ $inbound }}/1024],
            ['Outbound', {{ $outbound }}/1024],
            ['Manuales',{{ $manual }}/1024],
            ['Buzon de Voz', {{ $buzon }}/1024],
            ['Audios', {{ $audios }}/1024]
        ]
    }]
});
});
</script>
<script>
$(function() {
    Highcharts.chart('container2', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
        },
        title: {
            text: 'Almacenamiento General'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.2f} %<br>Capacidad: {point.y:.2f} GB</b>'
        },
        accessibility: {
            point: {
                valueSuffix: 'GB'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                depth: 35,
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.y:.2f} GB</b>'
                }
            }
        },
        series: [{
            name: 'Porcentaje en Disco',
            colorByPoint: true,
            data: [{
                name: 'Almacenamiento Posiciones',
                y: @foreach($config_empresas as $config) {{ $config->almacenamiento_posiciones/1024 }} @endforeach,
                sliced: true,
                selected: true
            }, {
                name: 'Almacenamiento Adicional',
                y: @foreach($config_empresas as $config) {{ $config->almacenamiento_adicional/1024 }} @endforeach
            }]
        }]
    });
});
</script>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fas fa-hdd"></i> <b>Almacenamiento</b></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-12 viewCreate"></div>
            <div id="container"></div>
            <div id="container2"></div>
        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div><!-- ./box-primary -->

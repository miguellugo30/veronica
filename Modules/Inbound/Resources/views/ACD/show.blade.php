    <!-- Info boxes -->
    <!--div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fas fa-globe"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total de llamadas</span>
                    <span class="info-box-number">90</span>
                </div>
                <! /.info-box-content->
            </div>
            <-- /.info-box ->
        </div>
        <!-/.col ->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fas fa-phone"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Contestadas</span>
                    <span class="info-box-number">41,410</span>
                </div>
                <!- /.info-box-content ->
            </div>
            <!- /.info-box ->
        </div>
        <!- /.col ->

        <!- fix for small devices only ->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fas fa-phone-slash"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Abandonadas</span>
                    <span class="info-box-number">760</span>
                </div>
                <!- /.info-box-content ->
            </div>
            <!- /.info-box ->
        </div>
        <!- /.col ->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fas fa-share"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Desviadas</span>
                    <span class="info-box-number">2,000</span>
                </div>
                <!- /.info-box-content->
            </div>
            <!- /.info-box ->
        </div>
        <!- /.col->
    </div-->
    <!-- /.row -->
     <!-- Main row -->
    <div class="row">
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
                                        <td class="text-center">40</td>
                                        <td class="text-center">55%</td>
                                    </tr>
                                    <tr>
                                        <td>Abandonadas</td>
                                        <td class="text-center">20</td>
                                        <td class="text-center">70%</td>
                                    </tr>
                                    <tr>
                                        <td>Desviadas</td>
                                        <td class="text-center">5</td>
                                        <td class="text-center">30%</td>
                                    </tr>
                                    <tr>
                                        <td>Promedio de Espera</td>
                                        <td class="text-center">00:00:08 Hrs.</td>
                                        <td class="text-center"></td>
                                    </tr>
                                    <tr>
                                        <td>Promedio de Llamada</td>
                                        <td class="text-center">00:00:09 Hrs.</td>
                                        <td class="text-center"></td>
                                    </tr>
                                    <tr>
                                        <td>Promedio de Abandono</td>
                                        <td class="text-center">00:00:06 Hrs.</td>
                                        <td class="text-center"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col">
                            <div id="container" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="box box-info">
                <div class="box-header">
                    <i class="fas fa-bookmark"></i>
                    <h3 class="box-title">CAMPANA B</h3>
                </div>
                <div class="box-body">
                    <div class="row ">
                        <div class="col align-middle">
                            <table class="table table-bordered table-striped align-middle">
                                <thead class="thead-light">
                                    <tr class="text-center">
                                        <th colspan="3">Estadísticas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr >
                                        <td>Contestadas</td>
                                        <td class="text-center">40</td>
                                        <td class="text-center">55%</td>
                                    </tr>
                                    <tr>
                                        <td>Abandonadas</td>
                                        <td class="text-center">20</td>
                                        <td class="text-center">70%</td>
                                    </tr>
                                    <tr>
                                        <td>Desviadas</td>
                                        <td class="text-center">5</td>
                                        <td class="text-center">30%</td>
                                    </tr>
                                    <tr>
                                        <td>Promedio de Espera</td>
                                        <td class="text-center">00:00:08 Hrs.</td>
                                        <td class="text-center"></td>
                                    </tr>
                                    <tr>
                                        <td>Promedio de Llamada</td>
                                        <td class="text-center">00:00:09 Hrs.</td>
                                        <td class="text-center"></td>
                                    </tr>
                                    <tr>
                                        <td>Promedio de Abandono</td>
                                        <td class="text-center">00:00:06 Hrs.</td>
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
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
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

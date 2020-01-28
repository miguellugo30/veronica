<style>
.hora{
    background-color: white;
    display: inline-flex;
    border: 1px solid #ccc;
    color: #555;
}
.hora input{
    border: none;
    color: #555;
    text-align: center;
    width: 50px;
    height: 29px;
}
</style>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><b><i class="fas fa-filter"></i> Filtro</b></h3>
        <div class="box-tools pull-right">
            <button class='btn btn-primary btn-sm nuevo-reporte' style='display:none'>
                Nuevo Reporte
            </button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row filtro-reporte">
            <div class="col-12 viewIndex">
                <form>
                    <div class="container">
                        <div class="row justify-content-md-center">
                            <div class="alert alert-dark col-8" role="alert">
                                <b>Filtros por fecha</b>
                                @csrf
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="fecha-inicio" class="col-sm-5 col-form-label col-form-label-sm">Fecha Inicio:</label>
                                    <div class="col-sm-6">
                                        <input type="date" class="form-control form-control-sm" name="fecha-inicio" id="fecha-inicio" placeholder="Fecha Inicio">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fecha-fin" class="col-sm-5 col-form-label col-form-label-sm">Fecha Fin:</label>
                                    <div class="col-sm-6">
                                        <input type="date" class="form-control form-control-sm" name="fecha-fin" id="fecha-fin" placeholder="Fecha Fin">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="hora-inicio" class="col-sm-5 col-form-label col-form-label-sm">Hora Inicio:</label>
                                    <div class="col-sm-4 hora">
                                        <input type="number" name="hora_inicio_1" id="hora_inicio" min="00" max="23" value="00" class="form-control form-control-sm" placeholder="--" size="2" onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;">:
                                        <input type="number" name="min_inicio_1" id="min_inicio"  min="0" max="59" value="00" class="form-control form-control-sm" placeholder="--" size="2" onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="hora-fin" class="col-sm-5 col-form-label col-form-label-sm">Hora Fin:</label>
                                    <div class="col-sm-4 hora">
                                        <input type="number" name="hora_fin_1" id="hora_fin" min="0" max="23" value="23" class="form-control form-control-sm" placeholder="--" onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;">:
                                        <input type="number" name="min_fin_1" id="min_fin"  min="0" max="59" value="59" class="form-control form-control-sm" placeholder="--" onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <button type="submit" class="btn btn-primary generarReporteACD">Generar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div>
<div class="box box-primary" id='body-reporte' style='display:none'>
    <div class="box-header with-border">
        <h3 class="box-title"><b><i class="fas fa-filter"></i> Reporte</b></h3>
        <!--div class="box-tools pull-right">
            <button class='btn btn-primary btn-sm descargar-reporte' >
                <i class="fas fa-circle-notch fa-spin" style="display:none"></i>
                Descargar
            </button>
        </div-->
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-12 viewReporteACD">
            </div>
        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div>
<iframe id="iFrameDescarga" src="" frameborder="0" style="display:none"></iframe>

<script>
    /*
$(function() {
        $("#fecha-inicio").daterangepicker({
                                            "showDropdowns": true,
                                            "timePicker": true,
                                            "timePicker24Hour": true,
                                            "locale": {
                                                "format": "DD/MM/YYYY",
                                                "separator": " - ",
                                                "applyLabel": "Seleccionar",
                                                "cancelLabel": "Cancelar",
                                                "fromLabel": "Desde",
                                                "toLabel": "Hasta",
                                                "customRangeLabel": "Custom",
                                                "weekLabel": "W",
                                                "daysOfWeek": [
                                                    "Do",
                                                    "Lu",
                                                    "Ma",
                                                    "Mi",
                                                    "Ju",
                                                    "Vi",
                                                    "Sa"
                                                ],
                                                "monthNames": [
                                                    "Enero",
                                                    "Febrero",
                                                    "Marzo",
                                                    "Abril",
                                                    "Mayo",
                                                    "Junio",
                                                    "Julio",
                                                    "Agosto",
                                                    "Septiembre",
                                                    "Octubre",
                                                    "Noviembre",
                                                    "Diciembre"
                                                ],
                                                "firstDay": 1
                                            },
                                            "opens": "center",
                                        });

                                        var dateFormat = "mm/dd/yy",
    from = $("#fecha-inicio")
        .datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 2,
            dateFormat: "dd/mm/yy"
        })
        .on("change", function() {
            to.datepicker("option", "minDate", getDate(this));
        }),
        to = $("#fecha-fin").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            numberOfMonths: 2,
            dateFormat: "dd/mm/yy"
        })
        .on("change", function() {
            from.datepicker("option", "maxDate", getDate(this));
        });

    function getDate(element) {
        var date;
        try {
            date = $.datepicker.parseDate(dateFormat, element.value);
        } catch (error) {
            date = null;
        }
        console.log( date );
        return date;
    }
});

    */

</script>


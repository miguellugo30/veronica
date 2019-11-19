<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><b><i class="fas fa-filter"></i> Filtro</b></h3>
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
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-sm" name="fecha-inicio" id="fecha-inicio" placeholder="Fecha Inicio">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fecha-fin" class="col-sm-5 col-form-label col-form-label-sm">Fecha Fin:</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-sm" name="fecha-fin" id="fecha-fin" placeholder="Fecha Fin">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="hora-inicio" class="col-sm-5 col-form-label col-form-label-sm">Hora Inicio:</label>
                                    <div class="col-sm-7">
                                        <input type="date" class="form-control form-control-sm" name="hora-inicio" id="hora-inicio" placeholder="col-form-label-sm">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="hora-fin" class="col-sm-5 col-form-label col-form-label-sm">Hora Fin:</label>
                                    <div class="col-sm-7">
                                        <input type="date" class="form-control form-control-sm" name="hora-inicio" id="hora-fin" placeholder="col-form-label-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <div class="alert alert-dark col-8" role="alert">
                                <b>Filtros por numero</b>
                            </div>
                        </div>

                        <div class="row justify-content-md-center">
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="fecha-inicio" class="col-sm-5 col-form-label col-form-label-sm">Numero Origen:</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-sm" name="fecha-inicio" id="fecha-inicio" placeholder="Numero Origen">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="fecha-inicio" class="col-sm-5 col-form-label col-form-label-sm">Numero Destino:</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control form-control-sm" name="fecha-inicio" id="fecha-inicio" placeholder="Numero Destino">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <button type="submit" class="btn btn-primary generarReporteDesglose">Generar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div>
<div class="box box-primary box-reporte" style="display:none">
    <div class="box-header with-border">
        <h3 class="box-title"><b><i class="fas fa-filter"></i> Reporte</b></h3>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-12 viewReporte">

            </div>
        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div>



<script>
$(function() {
    /*
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

    */

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

</script>


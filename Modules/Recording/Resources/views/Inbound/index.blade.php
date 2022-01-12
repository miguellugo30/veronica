<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title"><b><i class="fas fa fa-filter"></i> Filtro</b></h3>
        <div class="card-tools">
            <button class='btn btn-primary btn-sm nuevo-reporte' style='display:none'>
                Nuevo Reporte
            </button>
        </div>
    </div><!--card-header-->
    <div class="card-body">
        <div class="body-filtro">
            <form enctype="multipart/form-data" id="filtargrabaciones" method="post">
                <div class="row justify-content-md-center">
                    <div class="alert alert-dark col-6" role="alert">
                        <b>Filtros por fecha</b>
                        @csrf
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <div class="col-3">
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label" for="fechaIni"><b>Fecha Inicio:</b></label>
                            <div class="col-sm-7">
                                <input class="form-control form-control-sm" type="date" value="<?php echo date('Y-m-d'); ?>" name="fechaIni" id="fechaIni"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label" for="fechaFin"><b>Fecha Fin:</b></label>
                            <div class="col-sm-7">
                                <input class="form-control form-control-sm" type="date" value="<?php echo date('Y-m-d'); ?>" name="fechaFin" id="fechaFin"/>
                            </div>
                        </div>
                    </div><!-- ./col -->
                    <div class="col-3">
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label" for="hrIni"><b>Hora Inicio:</b></label>
                            <div class="col-sm-7">
                                <input class="form-control form-control-sm" type="time" value="00:00" name="hrIni" id="hrIni"/>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label" for="hrFin"><b>Hora Fin:</b></label>
                            <div class="col-sm-7">
                                <input class="form-control form-control-sm" type="time" value="23:59" name="hrFin" id="hrFin"/>
                            </div>
                        </div>
                    </div><!-- ./col -->
                </div><!-- ./row -->
                <div class="row justify-content-md-center">
                    <button type="submit" class="btn btn-primary btn-sm filtrar">Generar</button>
                </div>
            </form>
        </div><!-- ./row -->
    </div><!--card-header-->
  </div>

  <div class="card card-outline card-primary" id='body-reporte' style='display:none'>
    <div class="card-header">
        <h3 class="card-title"><b><i class="fas fa fa-filter"></i> Reporte: <label id="rangoFiltro"></label></b></h3>
        <div class="card-tools">
            <button class='btn btn-primary btn-sm descargar-reporte' >
                <i class="far fa-file-excel"></i>
                Descargar excel
            </button>
            <button class='btn btn-primary btn-sm descargar-grabaciones' >
                <i class="fas fa-download"></i>
                Descargar grabaciones
            </button>
            <button class='btn btn-primary btn-sm eliminar-grabaciones' >
                <i class="fas fa-trash-alt"></i>
                Eliminar grabaciones
            </button>
        </div>
    </div><!--card-header-->
    <div class="card-body">
        <div class="row ">
            <div class="box-tools">
                <div class="col-12">
                    <i class="fas fa-circle text-secondary"></i> La grabacion esta en el servidor de grabaciones<br>
                    <i class="fas fa-circle text-primary"></i> La grabacion esta en el FTP del cliente
                </div>
            </div>
            <div class="col-12 viewreportedesglose"></div>
        </div><!-- /.row -->
    </div><!--card-header-->
  </div>
<iframe id="iFrameDescarga" src="" frameborder="0" style="display:none"></iframe>
<!-- MODAL -->
<div class="modal fade " tabindex="-1" id="modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tituloModal"><i class="fas fa-volume-up"></i> Reproducir audio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center" id="modal-body">
                    ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary float-left" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIN MODAL -->

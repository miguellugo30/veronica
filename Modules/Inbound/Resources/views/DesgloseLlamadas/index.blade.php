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

<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title"><b><i class="fas fa-filter"></i> Filtro Reporte Desglose de Llamadas</b></h3>
        <div class="card-tools pull-right">
            <button class='btn btn-primary btn-sm nuevo-reporte' style='display:none'>
                Nuevo Reporte
            </button>
          </div>
    </div><!--card-header-->
    <div class="card-body">
        <div class="row body-filtro">
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
                                        <input type="date" class="form-control form-control-sm" name="fechainicio" id="fechainicio" placeholder="col-form-label-sm">
                                        @csrf
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="fecha-fin" class="col-sm-5 col-form-label col-form-label-sm">Fecha Fin:</label>
                                    <div class="col-sm-7">
                                        <input type="date" class="form-control form-control-sm" name="fechafin" id="fechafin" placeholder="col-form-label-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group row">
                                    <label for="hora-inicio" class="col-sm-5 col-form-label col-form-label-sm">Hora Inicio:</label>
                                    <div class="hora col-sm-5">
                                    <input type="number" name="hora_inicio" id="hora_inicio" min="00" max="23" class="form-control form-control-sm" value="00" placeholder="00" size="2" onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;">:
                                    <input type="number" name="min_inicio" id="min_inicio"  min="0" max="59" class="form-control form-control-sm" value="00" placeholder="00" size="2" onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="hora-fin" class="col-sm-5 col-form-label col-form-label-sm">Hora Fin:</label>
                                    <div class="hora col-sm-5">
                                    <input type="number" name="hora_fin" id="hora_fin" min="00" max="23" class="form-control form-control-sm" value="23" placeholder="23" size="2" onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;">:
                                    <input type="number" name="min_fin" id="min_fin"  min="0" max="59" class="form-control form-control-sm" value="59" placeholder="59" size="2" onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-md-center">
                            <button type="submit" class="btn btn-primary btn-sm generardesglose">Generar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.row -->
    </div><!--card-header-->
  </div>

<div class="box box-primary" id='body-reporte' style='display:none'>
    <div class="box-header with-border">
        <h3 class="box-title"><b><i class="fas fa-filter"></i> Desglose</b></h3>
        <div class="box-tools pull-right">
            <button class='btn btn-primary btn-sm descargar-reporte' >
                <i class="fas fa-circle-notch fa-spin" style="display:none"></i>
                Descargar
            </button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row ">
            <div class="col-12 viewreportedesglose">
            </div>
        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div>

<iframe id="iFrameDescarga" src="" frameborder="0" style="display:none"></iframe>

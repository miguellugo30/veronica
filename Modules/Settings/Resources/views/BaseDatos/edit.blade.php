<div class="col">
    <div class="form-group detailPlantilla">
        <h5>Base de datos: {{$baseDatos->nombre}}</h5>
    </div>
    <div class="form-group detailPlantilla">
        <h5>Plantilla en uso: {{$plantilla->nombre}}</h5>
        <table class="table table-bordered table-sm">
            <caption>Campos de plantilla</caption>
            <thead>
                <tr class="table-active">
                    @foreach ($plantilla->Plantillas_campos->sortBy('orden') as $campo)
                        <td>
                            @foreach ($campos as $v)
                                @if ($v->id == $campo->fk_campos_plantilla_empresa_fk_cat_campos_plantilla_id)
                                    {{ $v->nombre }}
                                @endif
                            @endforeach
                        </td>
                    @endforeach
                </tr>
            </thead>
        </table>
    </div>
    <form method="POST" id="NewBaseDatosForm" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="baseDatosId" id="baseDatosId" value="{{$baseDatos->id}}">
        <div class="form-group">
            <label for="accion"><b>Accion a realizar *:</b></label>
            <select name="accion" id="accion" class="form-control form-control-sm">
                <option value="">Selecciona una acción</option>
                <option value="1">Agregar registros</option>
                <option value="2">Reemplazar registros no contactados</option>
                <option value="3">Reemplazar todos los registros</option>
            </select>
        </div>
        <div class="form-group">
            <label for="archivo_datos"><b>Archivo Adjunto *:</b></label>
            <input type="file" class="form-control-file" name="archivo_datos" id="archivo_datos">
        </div>
        <div class="form-group">
            <small class="form-text text-muted"> <b>*Campos obligatorios.</b></small>
        </div>
    </form>
</div>
<div class="alert alert-primary div-cargando text-center" role="alert" style="display:none">
    <!--button class="btn btn-primary" type="button" disabled>
    </button-->
        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        Cargando...
</div>
<div class="alert alert-danger print-error-msg" role="alert" style="display:none">
    <ul></ul>
</div>


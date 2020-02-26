<div class="col-12" style="float:none; margin:auto">
    <form method="POST" id="NewBaseDatosForm" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nombre"><b>Nombre *:</b></label>
            <input type="text" class="form-control form-control-sm" id="nombre" placeholder="Nombre">
            @csrf
        </div>
        <div class="form-group">
            <label for="ubicacion"><b>Plantilla *:</b></label>

            <select name="plantilla" id="plantilla" class="form-control form-control-sm">
                <option value="">Selecciona una plantilla</option>
                @foreach ($plantillas as $plantilla)
                    <option value="{{ $plantilla->id }}">{{ $plantilla->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group detailPlantilla">
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

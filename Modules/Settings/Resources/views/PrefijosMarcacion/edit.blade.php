<div class="row">
    <div class="col-12">
        <form enctype="multipart/form-data" id="altaprefijo" method="post">
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label for="nombre"><b>Nombre *:</b></label>
                    <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" value="{{ $Prefijos->nombre }}">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="descripcion"><b>Descripción *:</b></label>
                        <input type="text" class="form-control form-control-sm" id="descripcion" name="descripcion" value="{{ $Prefijos->descripcion }}">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="prefijo"><b>Prefijo *:</b></label>
                        <input type="text" class="form-control form-control-sm" id="prefijo" name="prefijo" value="{{ $Prefijos->prefijo }}">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="prefijo"><b>Prefijo Nuevo*:</b></label>
                        <input type="text" class="form-control form-control-sm" id="prefijoNuevo" name="prefijoNuevo" value="{{ $Prefijos->prefijo_nuevo }}">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <small class="form-text text-muted"> <b>*Campos obligatorios.</b></small>
            </div>
            <div class="alert alert-danger print-error-msg" role="alert" style="display:none">
                <ul></ul>
            </div>
        </form>
    </div>
</div>

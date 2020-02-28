<div class="row">
    <div class="col-12">
        <form enctype="multipart/form-data" id="altaperfil" method="post">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="nombre"><b>Nombre *:</b></label>
                        <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" value="{{ $perfiles->nombre }}">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="perfil"><b>Descripcion *:</b></label>
                        <input type="text" class="form-control form-control-sm" id="descripcion" name="descripcion" value="{{ $perfiles->descripcion }}">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="prefijo"><b>Prefijo *:</b></label>
                        <select name="prefijo" id="prefijo" class="form-control form-control-sm prefijo">
                            <option value="">Selecciona un prefijo</option>
                            @foreach ($prefijos as $prefijo)
                                <option value="{{ $prefijo->id }}" {{ $prefijo->id == $perfil_marcacion->fk_prefijos_marcacion_id ? 'selected = "selected"':'' }}>{{ $prefijo->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="perfil"><b>Canal *:</b></label>
                        <select name="canal" id="canal" class="form-control form-control-sm canal">
                            <option value="">Selecciona un canal</option>
                            @foreach ($canales as $canal)
                            <option value="{{ $canal->Cat_Tipo_Canales->id }}" {{ $canal->Cat_Tipo_Canales->id == $perfil_marcacion->fk_canales_id ? 'selected = "selected"':'' }}>{{ $canal->Cat_Tipo_Canales->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="perfil"><b>Did *:</b></label>
                        <select name="did" id="did" class="form-control form-control-sm did">
                            <option value="">Selecciona un did</option>
                            @foreach ($did as $di)
                            <option value="{{ $di->id }}" {{ $di->id == $perfil_marcacion->fk_dids_id ? 'selected = "selected"':'' }}>{{ $di->did }}</option>
                            @endforeach
                        </select>
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

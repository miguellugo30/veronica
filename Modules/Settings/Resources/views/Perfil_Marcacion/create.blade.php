<div class="row">
    <div class="col-12">
        <form enctype="multipart/form-data" id="altaperfil" method="post">
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label for="prefijo"><b>Prefijo *:</b></label>
                        <select name="prefijo" id="prefijo" class="form-control form-control-sm">
                            <option disabled selected value="">Seleccione un Prefijo de Marcacion</option>
                                @foreach ($prefijos as $prefijo)
                                    <option value="{{ $prefijo->id }}">{{ $prefijo->nombre }}</option>
                                @endforeach
                        </select>
                        @csrf
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="perfil"><b>Perfil *:</b></label>
                        <select name="perfil" id="perfil" class="form-control form-control-sm">
                            <option disabled selected value="">Seleccione un Perfil</option>
                                @foreach ($perfiles as $perfil)
                                    <option value="{{ $perfil->id }}">{{ $perfil->nombre }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="canal"><b>Canal *:</b></label>
                        <select name="canal" id="canal" class="form-control form-control-sm">
                            <option disabled selected value="">Seleccione un Canal</option>
                                @foreach ($canales as $canal)
                                    <option value="{{ $canal->Cat_Tipo_Canales->id }}">{{ $canal->Cat_Tipo_Canales->nombre }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="did"><b>Did *:</b></label>
                        <select name="did" id="did" class="form-control form-control-sm">
                            <option disabled selected value="">Seleccione un Did</option>
                                @foreach ($did as $di)
                                    <option value="{{ $di->id }}">{{ $di->did }}</option>
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

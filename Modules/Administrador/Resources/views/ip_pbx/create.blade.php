<div class="row justify-content-md-center">
    <div class="col col-6">
        <div class="form-group">
            <label for="basedatos">Base de datos *:</label>
            <select name="basedatos" id="basedatos" class="form-control form-control-sm">
                <option value="">Selecciona una base de datos</option>
                @foreach( $baseDatos as $baseDato )
                <option value="{{ $baseDato->id }}">{{ $baseDato->nombre }} || {{ $baseDato->ip }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="media_server">Media Server *:</label>
            <input type="text" class="form-control form-control-sm" id="media_server" placeholder="Media Server">
            @csrf
        </div>
        <div class="form-group">
            <label for="ip_pbx">IP PBX *:</label>
            <input type="text" class="form-control form-control-sm" id="ip_pbx" placeholder="IP PBX">
            @csrf
        </div>
        <div class="form-group">
            <small class="form-text text-muted"> <b>*Campos obligatorios.</b></small>
        </div>
    </div>
    <div class="col col-6">
        <fieldset>
            <legend>
                <i class="far fa-hdd"></i>
                NAS
            </legend>
            @foreach( $cat_nas as $nas )
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="nas[]" value="{{ $nas->id }}">
                        {{ $nas->nombre }} || {{ $nas->ip_nas }}
                    </label>
                </div>
            @endforeach
        </fieldset>
    </div>
    <div class="alert alert-danger print-error-msg" role="alert" style="display:none">
        <ul></ul>
    </div>
</div>
<!--div class="col-8" style="float:none; margin:auto">
        <button type="submit" class="btn btn-warning btn-sm cancelPbx"><i class="fas fa-times"></i> Cancelar</button>
        <button type="submit" class="btn btn-primary btn-sm savePbx float-right"><i class="fas fa-save"></i> Guardar</button>
</div-->


<fieldset>
    <legend>
        <i class="fas fa-server"></i>
        Nuevo PBX
    </legend>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="col-md-6">
            <div class="form-group">
                <label for="media_server">Media Server</label>
                <input type="text" class="form-control" id="media_server" placeholder="Media Server">
                @csrf
            </div>
            <div class="form-group">
                <label for="ip_pbx">IP PBX</label>
                <input type="text" class="form-control" id="ip_pbx" placeholder="IP PBX">
                @csrf
            </div>
        </div>
        <div class="col-md-6">
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
    </div>
    <div class="col-md-12">
        <div class="col-md-6" style="float:none; margin:auto">
            <div class="col-md-6" style="text-align:left">
                <button type="submit" class="btn btn-warning cancelPbx"><i class="fas fa-times"></i> Cancelar</button>
            </div>
            <div class="col-md-6" style="text-align:right">
                <button type="submit" class="btn btn-primary savePbx"><i class="fas fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
    <br>
    <br>
</fieldset>

<fieldset>
    <legend>
        <i class="fas fa-project-diagram"></i>
        Nueva Troncal
    </legend>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="form-group">
            <label for="distribuidores">Distribuidor</label>
            <select name="distribuidores" id="distribuidores" class="form-control">
                <option value="" >Selecciona un distribuidor</option>
                @foreach( $distribuidores as $distribuidor )
                    <option value="{{ $distribuidor->id }}" >{{ $distribuidor->servicio }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="distribuidores">Protocolo</label>
            <select name="distribuidores" id="distribuidores" class="form-control">
                <option value="" >Selecciona un protocolo</option>
                <option value="SIP" >SIP</option>
                <option value="LOCAL/" >LOCAL/</option>
            </select>
        </div>
        <div class="form-group">
            <label for="nombre">Troncal</label>
            <input type="text" class="form-control" id="nombre" placeholder="Nombre" required>
            @csrf
        </div>
        <div class="form-group">
            <label for="nombre">Descripci&oacute;n</label>
            <input type="text" class="form-control" id="descripcion" placeholder="Descripcion" required>
        </div>
        <div class="form-group">
            <label for="ip_media">IP Media</label>
            <select name="ip_media" id="ip_media" class="form-control">
                <option value="" >Selecciona un Media</option>
                @foreach( $medias as $media )
                    <option value="{{ $media->id }}" >{{ $media->ip_pbx." :: ".$media->media_server }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="ip_host">IP Host</label>
            <input type="text" class="form-control" id="ip_host" placeholder="IP Host" required>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-6" style="float:none; margin:auto">
            <div class="col-md-6" style="text-align:left">
                <button type="submit" class="btn btn-warning cancelTroncal"><i class="fas fa-times"></i> Cancelar</button>
            </div>
            <div class="col-md-6" style="text-align:right">
                <button type="submit" class="btn btn-primary saveTroncal"><i class="fas fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
    <br>
    <br>
</fieldset>

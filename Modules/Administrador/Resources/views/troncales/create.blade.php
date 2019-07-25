<div class="col-6" style="float:none; margin:auto">
    <div class="form-group">
        <label for="distribuidores">Distribuidor</label>
        <select name="distribuidores" id="distribuidores" class="form-control form-control-sm">
            <option value="" >Selecciona un distribuidor</option>
            @foreach( $distribuidores as $distribuidor )
                <option value="{{ $distribuidor->id }}" >{{ $distribuidor->servicio }}</option>
            @endforeach
        </select>
    </div>
    <!--div class="form-group">
        <label for="distribuidores">Protocolo</label>
        <select name="distribuidores" id="distribuidores" class="form-control form-control-sm">
            <option value="" >Selecciona un protocolo</option>
            <option value="SIP" >SIP</option>
            <option value="LOCAL/" >LOCAL/</option>
        </select>
    </div-->
    <div class="form-group">
        <label for="nombre">Troncal</label>
        <input type="text" class="form-control form-control-sm" id="nombre" placeholder="Nombre" required>
        @csrf
    </div>
    <div class="form-group">
        <label for="nombre">Descripci&oacute;n</label>
        <input type="text" class="form-control form-control-sm" id="descripcion" placeholder="Descripcion" required>
    </div>
    <div class="form-group">
        <label for="ip_media">IP Media</label>
        <select name="ip_media" id="ip_media" class="form-control form-control-sm">
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
<div class="col-12">
    <div class="col-6" style="float:none; margin:auto">
        <button type="submit" class="btn btn-warning btn-sm cancelTroncal"><i class="fas fa-times"></i> Cancelar</button>
        <button type="submit" class="btn btn-primary btn-sm saveTroncal float-right"><i class="fas fa-save"></i> Guardar</button>
    </div>
</div>

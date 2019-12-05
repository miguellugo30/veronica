<div class="col-12" style="float:none; margin:auto">
    <div class="form-group">
        <label for="distribuidores">Distribuidor</label>
        <select name="distribuidores" id="distribuidores" class="form-control form-control-sm">
            <option value="" >Selecciona un distribuidor</option>
            @foreach( $distribuidores as $distribuidor )
                <option value="{{ $distribuidor->id }}" >{{ $distribuidor->servicio }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="nombre">Troncal</label>
        <input type="text" class="form-control form-control-sm" id="nombre" placeholder="Troncal" required>
        @csrf
    </div>
    <div class="form-group">
        <label for="nombre">Descripci&oacute;n</label>
        <input type="text" class="form-control form-control-sm" id="descripcion" placeholder="Descripcion" required>
    </div>
    <div class="form-group">
        <label for="ip_host">IP Host</label>
        <input type="text" class="form-control" id="ip_host" placeholder="IP Host" required>
    </div>
    <div class="form-group">
        <label for="mediaserver">Media Server</label>
        <select name="mediaserver" id="mediaserver" class="form-control form-control-sm">
            <option value="" >Selecciona un Media Server</option>
            @foreach( $mediaserver as $ms )
                <option value="{{ $ms->ip_pbx }}" >{{ $ms->media_server }}</option>
            @endforeach
        </select>
    </div>
</div>

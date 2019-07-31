<div class="col-12" style="float:none; margin:auto">
    <div class="form-group">
        <label for="distribuidores">Distribuidor</label>
        <select name="distribuidores" id="distribuidores" class="form-control form-control-sm">
            <option value="" >Selecciona un distribuidor</option>
            @foreach( $distribuidores as $distribuidor )
                <option value="{{ $distribuidor->id }}"  {{ $distribuidor->id ==  $troncal->Cat_Distribuidor->id ? 'selected="selected"' : '' }}>{{ $distribuidor->servicio }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="nombre">Troncal</label>
        <input type="text" class="form-control form-control-sm" id="nombre" placeholder="Nombre" value="{{ $troncal->nombre }}">
        <input type="hidden" name="id" id="id" value="{{ $troncal->id }}">
        @csrf
    </div>
    <div class="form-group">
        <label for="descripcion">Descripci&oacute;n</label>
        <input type="text" class="form-control form-control-sm" id="descripcion" placeholder="descripcion" value="{{ $troncal->descripcion }}">
    </div>
    <div class="form-group">
        <label for="ip_media">IP Media</label>
        <select name="ip_media" id="ip_media" class="form-control form-control-sm">
            @foreach( $medias as $media )
                <option value="{{ $media->id }}" {{ $media->id == $troncal->Cat_IP_PBX_id ? "selected" : '' }}>{{ $media->media_server." :: ".$media->ip_pbx }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="ip_host">IP Host</label>
        <input type="text" class="form-control form-control-sm" id="ip_host" placeholder="IP Host" value="{{ $troncal->ip_host }}">
    </div>
</div>
<!--div class="col-12">
    <div class="col-6" style="float:none; margin:auto">
        <button type="submit" class="btn btn-warning btn-sm cancelTroncal"><i class="fas fa-times"></i> Cancelar</button>
        <button type="submit" class="btn btn-danger btn-sm deleteTroncal"><i class="fas fa-trash-alt"></i> Eliminar</button>
        <button type="submit" class="btn btn-primary btn-sm updateTrocal float-right"><i class="fas fa-save"></i> Guardar</button>
    </div>
</div-->

<div class="col-12" style="float:none; margin:auto">
    <div class="form-group">
        <label for="distribuidores">Distribuidor *:</label>
        <select name="distribuidores" id="distribuidores" class="form-control form-control-sm">
            <option value="" >Selecciona un distribuidor</option>
            @foreach( $distribuidores as $distribuidor )
                <option value="{{ $distribuidor->id }}"  {{ $distribuidor->id ==  $troncal->Cat_Distribuidor->id ? 'selected="selected"' : '' }}>{{ $distribuidor->servicio }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="nombre">Troncal *:</label>
        <input type="text" class="form-control form-control-sm" id="nombre" placeholder="Nombre" value="{{ $troncal->nombre }}">
        <input type="hidden" name="id" id="id" value="{{ $troncal->id }}">
        @csrf
    </div>
    <div class="form-group">
        <label for="descripcion">Descripci&oacute;n *:</label>
        <input type="text" class="form-control form-control-sm" id="descripcion" placeholder="descripcion" value="{{ $troncal->descripcion }}">
    </div>
    <div class="form-group">
        <label for="ip_host">IP Host *:</label>
        <input type="text" class="form-control" id="ip_host" placeholder="IP Host" value="@if(isset($troncales->host)) {{ $troncales->host }} @endif">
    </div>
    <div class="form-group">
        <label for="mediaserver">Media Server *:</label>
        <select name="mediaserver" id="mediaserver" class="form-control form-control-sm">
            <option value="" >Selecciona un Media Server</option>
            @foreach( $medias as $ms )
                <option value="{{ $ms->ip_pbx }}">{{ $ms->ip_pbx }} || {{ $ms->media_server }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <small class="form-text text-muted"> <b>*Campos obligatorios.</b></small>
    </div>
    <div class="alert alert-danger print-error-msg" role="alert" style="display:none">
        <ul></ul>
    </div>
</div>


<div class="form-group">
    <label for="distribuidores_empresa"><b>Distribuidor *:</b></label>
    <select name="distribuidores_empresa" id="distribuidores_empresa" class="form-control form-control-sm" {{ isset($empresa->Config_Empresas) ? 'disabled' : '' }}  >
        <option value="" >Selecciona un distribuidor</option>
        @if ( isset( $empresa->Config_Empresas ))
            @foreach( $distribuidores as $distribuidor )
                <option value="{{ $distribuidor->id }}" {{ $empresa->Config_Empresas->Cat_Distribuidor_id == $distribuidor->id ? 'selected="selected"' : ''  }}>{{ $distribuidor->servicio }}</option>
            @endforeach
        @else
            @foreach( $distribuidores as $distribuidor )
                <option value="{{ $distribuidor->id }}">{{ $distribuidor->servicio }}</option>
            @endforeach
        @endif
    </select>
</div>
<div class="form-group">
    <label for="nombre"><b>Nombre *:</b></label>
    <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Nombre" value="{{ isset( $empresa->nombre ) ? $empresa->nombre : '' }}" {{ isset( $empresa->nombre ) ? 'readonly' : '' }} >
    <input type="hidden" name="id_empresa" id="id_empresa" value="{{    isset( $empresa->id ) ?  $empresa->id : "" }}">
    <input type="hidden" name="action" id="action" value="dataEmpresa">
    @csrf
</div>
<div class="form-group">
    <label for="contacto_cliente"><b>Contacto Cliente *:</b></label>
    <input type="text" class="form-control form-control-sm" id="contacto_cliente" name="contacto_cliente" placeholder="Contacto Cliente" value="{{ isset( $empresa->contacto_cliente ) ? $empresa->contacto_cliente : "" }}">
</div>
<div class="form-group">
    <label for="direccion"><b>Dirección *:</b></label>
    <input type="text" class="form-control form-control-sm" id="direccion" name="direccion" placeholder="Direccion" value="{{  isset( $empresa->direccion ) ? $empresa->direccion : "" }}">
</div>
<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="ciudad"><b>Cuidad *:</b></label>
            <input type="text" class="form-control form-control-sm" id="ciudad" name="ciudad" placeholder="Cuidad" value="{{   isset( $empresa->ciudad ) ? $empresa->ciudad : "" }}">
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="estado"><b>Estado *:</b></label>
            <input type="text" class="form-control form-control-sm" id="estado" name="estado" placeholder="Estado" value="{{   isset( $empresa->estado ) ? $empresa->estado : "" }}">
        </div>
    </div>
</div>
<div class="form-group">
    <label for="pais"><b>País *:</b></label>
    <input type="text" class="form-control form-control-sm" id="pais" name="pais" placeholder="Pais" value="{{ isset( $empresa->pais ) ? $empresa->pais : "" }}">
</div>
<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="telefono"><b>Teléfono *:</b></label>
            <input type="text" class="form-control form-control-sm" id="telefono" name="telefono" placeholder="Telefono" value="{{ isset( $empresa->telefono ) ? $empresa->telefono : "" }}">
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            <label for="movil"><b>Teléfono Móvil *:</b></label>
            <input type="text" class="form-control form-control-sm" id="movil" name="movil" placeholder="Telefono Movil" value="{{ isset( $empresa->movil ) ? $empresa->movil : "" }}">
        </div>
    </div>
</div>
<div class="form-group">
    <label for="correo"><b>Correo Electrónico *:</b></label>
    <input type="text" class="form-control form-control-sm" id="correo" name="correo" placeholder="Correo Electronico" value="{{   isset( $empresa->correo ) ? $empresa->correo : "" }}">
</div>
<div class="form-group">
    <small class="form-text text-muted"> <b>*Campos obligatorios.</b></small>
</div>
<div class="alert alert-danger print-error-msg" role="alert" style="display:none">
    <ul></ul>
</div>

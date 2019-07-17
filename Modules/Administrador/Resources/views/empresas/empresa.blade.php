<div class="form-group">
    <label for="distribuidores_empresa">Distribuidor</label>
    <select name="distribuidores_empresa" id="distribuidores_empresa" class="form-control input-sm">
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
    <label for="nombre">Nombre</label>
    <input type="text" class="form-control input-sm" id="nombre" name="nombre" placeholder="Nombre" value="{{ isset( $empresa->nombre ) ? $empresa->nombre : '' }}">
    <input type="hidden" name="id_empresa" id="id_empresa" value="{{    isset( $empresa->id ) ?  $empresa->id : "" }}">
    <input type="hidden" name="action" id="action" value="dataEmpresa">
    @csrf
</div>
<div class="form-group">
    <label for="contacto_cliente">Contacto Cliente</label>
    <input type="text" class="form-control input-sm" id="contacto_cliente" name="contacto_cliente" placeholder="Contacto Cliente" value="{{ isset( $empresa->contacto_cliente ) ? $empresa->contacto_cliente : "" }}">
</div>
<div class="form-group">
    <label for="direccion">Dirección</label>
    <input type="text" class="form-control input-sm" id="direccion" name="direccion" placeholder="Direccion" value="{{  isset( $empresa->direccion ) ? $empresa->direccion : "" }}">
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="ciudad">Cuidad</label>
        <input type="text" class="form-control input-sm" id="ciudad" name="ciudad" placeholder="Cuidad" value="{{   isset( $empresa->ciudad ) ? $empresa->ciudad : "" }}">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="estado">Estado</label>
        <input type="text" class="form-control input-sm" id="estado" name="estado" placeholder="Estado" value="{{   isset( $empresa->estado ) ? $empresa->estado : "" }}">
    </div>
</div>
<div class="form-group">
    <label for="pais">País</label>
    <input type="text" class="form-control input-sm" id="pais" name="pais" placeholder="Pais" value="{{ isset( $empresa->pais ) ? $empresa->pais : "" }}">
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="telefono">Teléfono</label>
        <input type="text" class="form-control input-sm" id="telefono" name="telefono" placeholder="Telefono" value="{{ isset( $empresa->telefono ) ? $empresa->telefono : "" }}">
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label for="movil">Teléfono Móvil</label>
        <input type="text" class="form-control input-sm" id="movil" name="movil" placeholder="Telefono Movil" value="{{ isset( $empresa->movil ) ? $empresa->movil : "" }}">
    </div>
</div>
<div class="form-group">
    <label for="correo">Correo Electrónico</label>
    <input type="text" class="form-control input-sm" id="correo" name="correo" placeholder="Correo Electronico" value="{{   isset( $empresa->correo ) ? $empresa->correo : "" }}">
</div>

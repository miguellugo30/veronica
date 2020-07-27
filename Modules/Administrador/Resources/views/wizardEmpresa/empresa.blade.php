<br><br>
@if ( Session::has( 'empresa' ) )
    @php
        $dataEmpresa = Session::get( 'empresa' );
    @endphp
@endif
<div class="row">
    <div class="col">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="distribuidores_empresa"><b>Distribuidor *:</b></label>
            <div class="col-sm-9">
                <select name="distribuidores_empresa" id="distribuidores_empresa" class="form-control form-control-sm"   >
                    <option value="" >Selecciona un distribuidor</option>
                    @foreach( $data['Cat_Distribuidor'] as $distribuidor )
                        <option value="{{ $distribuidor->id }}"  {{ isset( $dataEmpresa ) ? $distribuidor->id == $dataEmpresa['distribuidores_empresa'] ? 'selected' : '' : '' }}  >{{ $distribuidor->servicio }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="nombre"><b>Empresa*:</b></label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Empresa" value="{{ isset( $dataEmpresa ) ? $dataEmpresa['nombre'] : 'Veronica SA de CV' }}"  >
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="contacto_cliente"><b>Contacto *:</b></label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" id="contacto_cliente" name="contacto_cliente" placeholder="Contacto Cliente" value="{{ isset( $dataEmpresa ) ? $dataEmpresa['contacto_cliente'] : 'Miguel Chavez Lugo' }}">
            </div>
        </div>
    </div>
    <div class="col">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="direccion"><b>Dirección *:</b></label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" id="direccion" name="direccion" placeholder="Direccion" value="{{ isset( $dataEmpresa ) ? $dataEmpresa['direccion'] : 'Direccion' }}">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="ciudad"><b>Cuidad *:</b></label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" id="ciudad" name="ciudad" placeholder="Cuidad" value="{{ isset( $dataEmpresa ) ? $dataEmpresa['ciudad'] : 'Ciudad' }}">
            </div>
        </div>
    </div>
    <div class="col">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="estado"><b>Estado *:</b></label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" id="estado" name="estado" placeholder="Estado" value="{{ isset( $dataEmpresa ) ? $dataEmpresa['estado'] : 'Estado' }}">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="pais"><b>País *:</b></label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" id="pais" name="pais" placeholder="Pais" value="{{ isset( $dataEmpresa ) ? $dataEmpresa['pais'] : 'Pais' }}">
            </div>
        </div>
    </div>
    <div class="col">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="correo"><b>Correo Electrónico *:</b></label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" id="correo" name="correo" placeholder="Correo Electronico" value="{{ isset( $dataEmpresa ) ? $dataEmpresa['correo'] : 'miguel@mail.com' }}">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="telefono"><b>Teléfono *:</b></label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" id="telefono" name="telefono" placeholder="Telefono" value="{{ isset( $dataEmpresa ) ? $dataEmpresa['telefono'] : '123456789' }}">
            </div>
        </div>
    </div>
    <div class="col">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label" for="movil"><b>Teléfono Móvil*:</b></label>
            <div class="col-sm-9">
                <input type="text" class="form-control form-control-sm" id="movil" name="movil" placeholder="Telefono Movil" value="{{ isset( $dataEmpresa ) ? $dataEmpresa['movil'] : '0987654321' }}">
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <small class="form-text text-muted"> <b>*Campos obligatorios.</b></small>
</div>
<div class="alert alert-danger print-error-msg" role="alert" style="display:none">
    <ul></ul>
</div>

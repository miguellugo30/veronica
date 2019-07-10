<fieldset>
    <legend>
        <i class="far fa-building"></i>
        <b>Nueva Empresa</b>
    </legend>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="form-group">
            <label for="distribuidores_empresa">Distribuidor</label>
            <select name="distribuidores_empresa" id="distribuidores_empresa" class="form-control input-sm">
                <option value="" >Selecciona un distribuidor</option>
                @foreach( $distribuidores as $distribuidor )
                    <option value="{{ $distribuidor->id }}" >{{ $distribuidor->servicio }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control input-sm" id="nombre" name="nombre" placeholder="Nombre">
            <input type="hidden" name="action" id="action" value="dataEmpresa">
            @csrf
        </div>
        <div class="form-group">
            <label for="contacto_cliente">Contacto Cliente</label>
            <input type="text" class="form-control input-sm" id="contacto_cliente" name="contacto_cliente" placeholder="Contacto Cliente">
        </div>
        <div class="form-group">
            <label for="direccion">Dirección</label>
            <input type="text" class="form-control input-sm" id="direccion" name="direccion" placeholder="Direccion">
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="ciudad">Cuidad</label>
                <input type="text" class="form-control input-sm" id="ciudad" name="ciudad" placeholder="Cuidad">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="estado">Estado</label>
                <input type="text" class="form-control input-sm" id="estado" name="estado" placeholder="Estado">
            </div>
        </div>
        <div class="form-group">
            <label for="pais">País</label>
            <input type="text" class="form-control input-sm" id="pais" name="pais" placeholder="Pais">
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input type="text" class="form-control input-sm" id="telefono" name="telefono" placeholder="Telefono">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="movil">Teléfono Móvil</label>
                <input type="text" class="form-control input-sm" id="movil" name="movil" placeholder="Telefono Movil">
            </div>
        </div>
        <div class="form-group">
            <label for="correo">Correo Electrónico</label>
            <input type="text" class="form-control input-sm" id="correo" name="correo" placeholder="Correo Electronico">
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-6" style="float:none; margin:auto">
            <div class="col-md-6" style="text-align:left">
                <button type="submit" class="btn btn-warning cancelEmpresa"><i class="fas fa-times"></i> Cancelar</button>
            </div>
            <div class="col-md-6" style="text-align:right">
                <button type="submit" class="btn btn-primary saveEmpresa">Siguiente <i class="fas fa-arrow-alt-circle-right"></i></button>
            </div>
        </div>
    </div>
    <br>
    <br>
</fieldset>

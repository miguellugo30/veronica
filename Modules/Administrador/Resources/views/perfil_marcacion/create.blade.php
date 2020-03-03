<div class="col-md-12">
    @csrf
    <input type="hidden" name="id_empresa" id="id_empresa" value="{{ $id }}">
    <input type="hidden" name="action" id="action" value="dataPerfil">
    <!-- Mostrando los perfiles de marcacion de la empresa seleccionada -->
    <div class="form-group">
        <!-- Agregar el nombre -->
        <label for="nombre"><b>Nombre</b></label>
        <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Nombre">
    </div>
    <div class="form-group">
        <!-- Agregar la descripcion -->
        <label for="descripcion"><b>Descripcion</b></label>
        <input type="text" class="form-control form-control-sm" id="descripcion" name="descripcion" placeholder="Descripcion">
    </div>
    <div class="form-group">
        <!-- Agregar el prefijo de marcacion -->
        <label for="prefijo"><b>Prefijo</b></label>
        <select name="prefijo" id="prefijo" class="form-control form-control-sm prefijo">
            <option value="">Selecciona un prefijo</option>
            @foreach($prefijos as $prefijo)
            <option value="{{ $prefijo->id }}">{{ $prefijo->nombre }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <!-- Agregar el canal de marcacion -->
        <label for="canal"><b>Canal</b></label>
        <select name="canal" id="canal" class="form-control form-control-sm canal">
            <option value="">Selecciona un canal</option>
            @foreach($canales as $canal)
            <option value="{{ $canal->Cat_Tipo_Canales->id }}">{{ $canal->Cat_Tipo_Canales->nombre }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <!-- Agregar el did de marcacion -->
        <label for="did"><b>Did</b></label>
        <select name="did" id="did" class="form-control form-control-sm did">
            <option value="">Selecciona un did</option>
            @foreach($did as $di)
            <option value="{{ $di->id }}">{{ $di->did }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="col-12" style="padding:10px;">
        <!--button type="submit" class="btn btn-warning cancelExtension"><i class="fas fa-times"></i> Cancelar</button-->
        <button type="submit" class="btn btn-primary btn-sm  float-right savePerfilMarcacion"><i class="fas fa-save"></i> Guardar</button>
</div>

<div class="col-md-12">
    @csrf
    <input type="hidden" name="id_empresa" id="id_empresa" value="{{ $id }}">
    <input type="hidden" name="action" id="action" value="dataPrefijos">
    <!-- Mostrando los prefijos de marcacion de la empresa seleccionada -->
    <div class="form-group">
        <!-- Agregar el nombre -->
        <label for="Nombre_id">Nombre</label>
        <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Nombre">
    </div>
    <div class="form-group">
        <!-- Agregar la descripcion -->
        <label for="descripcion">Descripcion</label>
        <input type="text" class="form-control form-control-sm" id="descripcion" name="descripcion" placeholder="Descripcion">
    </div>
    <div class="form-group">
        <!-- Agregar el prefijo -->
        <label for="prefijo">Prefijo</label>
        <input type="text" class="form-control form-control-sm" id="prefijo" name="prefijo" placeholder="Prefijo">
    </div>
    <div class="form-group">
        <!-- Agregar el prefijo nuevo -->
        <label for="prefijoNuevo">Prefijo Nuevo</label>
        <input type="text" class="form-control form-control-sm" id="prefijoNuevo" name="prefijoNuevo" placeholder="Prefijo Nuevo">
    </div>
</div>
<div class="col-12" style="padding:10px;">
        <!--button type="submit" class="btn btn-warning cancelExtension"><i class="fas fa-times"></i> Cancelar</button-->
        <button type="submit" class="btn btn-primary btn-sm  float-right savePrefijoMarcacion"><i class="fas fa-save"></i> Guardar</button>
</div>

<div class="col-6" style="float:none; margin:auto">
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" class="form-control form-control-sm" id="nombre" placeholder="Nombre" value="{{ $subCategoria->nombre }}">
        <input type="hidden" name="id_subCate" id="id_subCate" value="{{ $id }}">
        @csrf
        @method('PUT')
    </div>
    <div class="form-group">
        <label for="email">Descripción</label>
        <input type="text" class="form-control form-control-sm" id="descripcion" placeholder="Descripcion" value="{{ $subCategoria->descripcion }}">
    </div>
    <div class="form-group">
        <label for="tipo">Tipo</label>
        <select name="tipo" id="tipo" class="form-control form-control-sm">
            <option value="1">Sistema</option>
            <option value="2">Cliente</option>
        </select>
    </div>
</div>
<div class="col-6" style="float:none; margin:auto">
    <button type="submit" class="btn btn-warning btn-sm cancelSubMenu"><i class="fas fa-times"></i> Cancelar</button>
    <button type="submit" class="btn btn-danger btn-sm deleteSubMenu"><i class="fas fa-trash-alt"></i> Eliminar</button>
    <button type="submit" class="btn btn-primary btn-sm editSubMenu float-right"><i class="fas fa-save"></i> Guardar</button>
</div>

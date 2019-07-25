<div class="col-6" style="float:none; margin:auto">
    <div class="form-group">
        <label for="nombre">Nombre</label>
        <input type="text" class="form-control form-control-sm" id="nombre" placeholder="Nombre" value="{{ $categoria->nombre }}">
        <input type="hidden" name="id_categoria" id="id_categoria" value="{{ $categoria->id }}">
        @csrf
        @method('PUT')
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <input type="text" class="form-control form-control-sm" id="descripcion" placeholder="Descripcion" value="{{ $categoria->descripcion}}">
    </div>
    <div class="form-group">
        <label for="tipo">Tipo</label>
        <select name="tipo" id="tipo" class="form-control form-control-sm">
            <option value="1" {{ $categoria->tipo == 1 ? 'selected="selected"' : '' }}>Sistema</option>
            <option value="2" {{ $categoria->tipo == 2 ? 'selected="selected"' : '' }}>Cliente</option>
        </select>
    </div>
</div>
<div class="col-md-6" style="float:none; margin:auto">
    <button type="submit" class="btn btn-warning btn-sm cancelMenu"><i class="fas fa-times"></i> Cancelar</button>
    <button type="submit" class="btn btn-danger btn-sm deleteMenu"><i class="fas fa-trash-alt"></i> Eliminar</button>
    <button type="submit" class="btn btn-primary btn-sm updateMenu float-right"><i class="fas fa-save"></i> Guardar</button>
</div>

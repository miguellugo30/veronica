<div class="col-6" style="float:none; margin:auto">
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" class="form-control form-control-sm" id="nombreEdit" name="nombreEdit" placeholder="Nombre" value="{{ $modulo->nombre }}">
        <input type="hidden" name="id_modulo" id="id_modulo" value="{{ $id }}">
        @csrf
    </div>
    <div class="form-group">
        <label for="email">Descripción</label>
        <input type="text" class="form-control form-control-sm" id="descripcionEdit" name="descripcionEdit" placeholder="Descripcion" value="{{ $modulo->descripcion }}">
    </div>
</div>
<div class="col-6"  style="float:none; margin:auto">
    <button type="submit" class="btn btn-warning btn-sm cancelModulo"><i class="fas fa-times"></i> Cancelar</button>
    <button type="submit" class="btn btn-danger btn-sm deleteModulo"><i class="fas fa-trash-alt"></i> Eliminar</button>
    <button type="submit" class="btn btn-primary btn-sm updateModulo float-right"><i class="fas fa-save"></i> Guardar</button>
</div>

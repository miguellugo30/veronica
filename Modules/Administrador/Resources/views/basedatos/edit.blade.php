<div class="col-6" style="float:none; margin:auto">
    <div class="form-group">
        <label for="name">Nombre</label>
        <input type="text" class="form-control form-control-sm" id="nombre" placeholder="Nombre" value="{{ $baseDatos->nombre }}">
        <input type="hidden" name="id" id="id" value="{{$id}}">
        @csrf
    </div>
    <div class="form-group">
        <label for="ubicacion">Ubicacion</label>
        <input type="text" class="form-control form-control-sm" id="ubicacion" placeholder="Ubicacion" value="{{ $baseDatos->ubicacion }}">
    </div>
    <div class="form-group">
        <label for="ip">IP</label>
        <input type="text" class="form-control form-control-sm" id="ip" placeholder="IP" value="{{ $baseDatos->ip }}">
    </div>
</div>
<div class="col-6" style="float:none; margin:auto">
    <button type="submit" class="btn btn-warning btn-sm cancelBaseDatos"><i class="fas fa-times"></i> Cancelar</button>
    <button type="submit" class="btn btn-danger btn-sm deleteBaseDatos"><i class="fas fa-trash-alt"></i> Eliminar</button>
    <button type="submit" class="btn btn-primary btn-sm updateBaseDatos float-right"><i class="fas fa-save"></i> Guardar</button>
</div>

<div class="col-12">
    <div class="form-group">
        <label for="nombre"><b>Nombre</b></label>
        <input type="text" class="form-control form-control-sm" id="nombre" placeholder="Nombre" value="{{ $categoria->nombre }}">
        <input type="hidden" name="id_categoria" id="id_categoria" value="{{ $categoria->id }}">
        <input type="hidden" name="id_permiso" id="id_permiso" value="{{ $categoria->nombre }}">
        @csrf
        @method('PUT')
    </div>
    <div class="form-group">
        <label for="descripcion"><b>Descripción</b></label>
        <input type="text" class="form-control form-control-sm" id="descripcion" placeholder="Descripcion" value="{{ $categoria->descripcion}}">
    </div>
    <div class="form-group">
        <label for="tipo"><b>Tipo</b></label>
        <select name="tipo" id="tipo" class="form-control form-control-sm">
            <option value="1" {{ $categoria->tipo == 1 ? 'selected="selected"' : '' }}>Sistema</option>
            <option value="2" {{ $categoria->tipo == 2 ? 'selected="selected"' : '' }}>Cliente</option>
        </select>
    </div>
</div>

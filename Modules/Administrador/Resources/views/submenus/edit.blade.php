<div class="col-12">
    <div class="form-group">
        <label for="name"><b>Nombre</b></label>
        <input type="text" class="form-control form-control-sm" id="nombre" placeholder="Nombre" value="{{ $subCategoria->nombre }}">
        <input type="hidden" name="id_subCate" id="id_subCate" value="{{ $id }}">
        @csrf
        @method('PUT')
    </div>
    <div class="form-group">
        <label for="email"><b>Descripción</b></label>
        <input type="text" class="form-control form-control-sm" id="descripcion" placeholder="Descripcion" value="{{ $subCategoria->descripcion }}">
    </div>
    <div class="form-group">
        <label for="tipo"><b>Tipo</b></label>
        <select name="tipo" id="tipo" class="form-control form-control-sm">
            <option value="1"  {{ $subCategoria->tipo == 1 ? 'selected="selected"' : '' }}>Sistema</option>
            <option value="2"  {{ $subCategoria->tipo == 2 ? 'selected="selected"' : '' }}>Cliente</option>
        </select>
    </div>
</div>

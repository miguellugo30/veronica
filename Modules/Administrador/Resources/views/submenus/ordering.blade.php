
<div class="col-6" style="float:none; margin:auto">
    <ul  id="sortable" class="list-group">
        @foreach ($subCategorias as $subCategoria)
            <li id="cat_{{ $subCategoria->id }}" class="list-group-item">{{ $subCategoria->nombre }}</li>
        @endforeach
    </ul>
    @csrf
    <input type="hidden" name="id_categoria" id="id_categoria" value="{{ $id }}">
</div>
<br>
<div class="col-6" style="float:none; margin:auto">
    <button type="submit" class="btn btn-warning btn-sm cancelSubMenu"><i class="fas fa-times"></i> Cancelar</button>
    <button type="submit" class="btn btn-primary btn-sm saveOrdeSubrMenu float-right"><i class="fas fa-save"></i> Guardar</button>
</div>

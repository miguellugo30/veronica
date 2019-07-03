<fieldset>
    <legend>
        <i class="fas fa-align-justify"></i>
        Ordenar Sub Menu
    </legend>
    <div class="col-md-6" style="float:none; margin:auto">
        <ul  id="sortable" class="list-group">
            @foreach ($subCategorias as $subCategoria)
                <li id="cat_{{ $subCategoria->id }}" class="list-group-item">{{ $subCategoria->nombre }}</li>
            @endforeach
        </ul>
        @csrf
        <input type="hidden" name="id_categoria" id="id_categoria" value="{{ $id }}">
    </div>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="col-md-6" style="text-align:left">
            <button type="submit" class="btn btn-warning cancelSubMenu"><i class="fas fa-times"></i> Cancelar</button>
        </div>
        <div class="col-md-6" style="text-align:right">
            <button type="submit" class="btn btn-primary saveOrdeSubrMenu"><i class="fas fa-save"></i> Guardar</button>
        </div>
    </div>
    <br>
    <br>
</fieldset>

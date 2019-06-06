<fieldset>
    <legend>
        <i class="fas fa-user"></i>
        Ordenar Sub Menu
    </legend>
    <div class="col-md-6" style="float:none; margin:auto">
        <ul  id="sortable" class="list-group">
            @foreach ($subCategorias as $subCategoria)
                <li id="cat_{{ $subCategoria->id }}" class="list-group-item">{{ $subCategoria->nombre }}</li>
            @endforeach
        </ul>
        @csrf
    </div>
    <div class="col-md-12" style="text-align:center">
        <button type="submit" class="btn btn-primary saveOrdeSubrMenu">Guardar</button>
        <button type="submit" class="btn btn-danger cancelSubMenu">Cancelar</button>
    </div>
    <br>
    <br>
</fieldset>

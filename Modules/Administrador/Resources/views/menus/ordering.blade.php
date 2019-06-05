<fieldset>
    <legend>
        <i class="fas fa-user"></i>
        Ordenar Menu
    </legend>
    <div class="col-md-6" style="float:none; margin:auto">
        <ul  id="sortable" class="list-group">
            @foreach ($categorias as $categoria)
                <li id="cat_{{ $categoria->id }}" class="list-group-item">{{ $categoria->nombre }}</li>
            @endforeach
        </ul>
        @csrf
    </div>
    <div class="col-md-12" style="text-align:center">
        <button type="submit" class="btn btn-primary saveOrderMenu">Guardar</button>
        <button type="submit" class="btn btn-danger cancelMenu">Cancelar</button>
    </div>
    <br>
    <br>
</fieldset>
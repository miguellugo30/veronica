<div class="col-6" style="float:none; margin:auto">
    <ul  id="sortable" class="list-group">
        @foreach ($categorias as $categoria)
            <li id="cat_{{ $categoria->id }}" class="list-group-item"><i class="fas fa-grip-vertical"></i> {{ $categoria->nombre }}</li>
        @endforeach
    </ul>
    @csrf
</div>
<div class="col-6" style="float:none; margin:auto">
    <button type="submit" class="btn btn-warning btn-sm cancelModulo"><i class="fas fa-times"></i> Cancelar</button>
    <button type="submit" class="btn btn-primary btn-sm saveOrderModulo float-right"><i class="fas fa-save"></i> Guardar</button>
</div>

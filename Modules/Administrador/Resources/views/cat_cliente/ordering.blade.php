<div class="col-6" style="float:none; margin:auto">
    <ul  id="sortable" class="list-group">
        @foreach ($cat_clientes as $cat_clientes)
            <li id="cat_{{ $cat_clientes->id }}" class="list-group-item">{{ $cat_clientes->nombre }}</li>
        @endforeach
    </ul>
    @csrf
</div>
<div class="col-6" style="float:none; margin:auto">
    <button type="submit" class="btn btn-warning cancelEdoCli"><i class="fas fa-times"></i> Cancelar</button>
    <button type="submit" class="btn btn-primary saveOrderEdoCli float-right"><i class="fas fa-save"></i> Guardar</button>
</div>

<fieldset>
    <legend>
        <i class="fas fa-th"></i>
        Ordenar Catalogo
    </legend>
    <div class="col-md-6" style="float:none; margin:auto">
        <ul  id="sortable" class="list-group">
            @foreach ($cat_clientes as $cat_clientes)
                <li id="cat_{{ $cat_clientes->id }}" class="list-group-item">{{ $cat_clientes->nombre }}</li>
            @endforeach
        </ul>
        @csrf
    </div>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="col-md-6" style="text-align:left">
            <button type="submit" class="btn btn-warning cancelEdoCli"><i class="fas fa-times"></i> Cancelar</button>
        </div>
        <div class="col-md-6" style="text-align:right">
            <button type="submit" class="btn btn-primary saveOrderEdoCli"><i class="fas fa-save"></i> Guardar</button>
        </div>
    </div>
    <br>
    <br>
</fieldset>

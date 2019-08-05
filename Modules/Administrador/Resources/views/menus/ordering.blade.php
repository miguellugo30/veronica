<div class="col-12">
    <ul  id="sortable" class="list-group">
        @foreach ($categorias as $categoria)
            <li id="cat_{{ $categoria->id }}" class="list-group-item"><i class="fas fa-grip-vertical"></i> {{ $categoria->nombre }}</li>
        @endforeach
    </ul>
    @csrf
</div>

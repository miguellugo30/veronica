<div class="col-12">
    <ul  id="sortable" class="list-group">
        @foreach ($cat_clientes as $cat_clientes)
            <li id="cat_{{ $cat_clientes->id }}" class="list-group-item"><i class="fas fa-grip-vertical"></i> {{ $cat_clientes->nombre }}</li>
        @endforeach
    </ul>
    @csrf
</div>

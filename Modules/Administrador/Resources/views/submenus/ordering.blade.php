<div class="col-12">
    <ul  id="sortable" class="list-group">
        @foreach ($subCategorias as $subCategoria)
            <li id="cat_{{ $subCategoria->id }}" class="list-group-item"><i class="fas fa-grip-vertical"></i> {{ $subCategoria->nombre }}</li>
        @endforeach
    </ul>
    @csrf
    <input type="hidden" name="id_categoria" id="id_categoria" value="{{ $id }}">
</div>

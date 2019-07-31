<div class="col-12">
    <ul  id="sortable" class="list-group">
        @foreach ($modulos as $modulos)
            <li id="mod_{{ $modulos->id }}" class="list-group-item"><i class="fas fa-grip-vertical"></i> {{ $modulos->nombre }}</li>
        @endforeach
    </ul>
    @csrf
</div>

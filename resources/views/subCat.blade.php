
<div class="collapse navbar-collapse" style="background-color:#367FA9">
    <ul class="nav navbar-nav">
        @foreach ($subCats as $subCat)
            <li class="subCat"><a data-id="{{ $subCat->id }}" style="cursor:pointer">{{ $subCat->nombre }}</span></a></li>
        @endforeach
    </ul>
</div>

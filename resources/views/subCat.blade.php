
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="background-color:#367FA9">
        <ul class="nav navbar-nav">
            @foreach ($subCats as $subCat)
                <li><a href="#">{{ $subCat->nombre }}</span></a></li>
            @endforeach
        </ul>
    </div><!-- /.navbar-collapse -->

<li class="nav-item">
    <a class="nav-link" data-widget="pushmenu" href="#">
        <i class="fas fa-bars"></i>
        <span class="sr-only">Navegación de palanca</span>
    </a>
</li>
<ul class="navbar-nav mr-auto">
    @foreach ($categorias as $c)
            <li class="nav-item" style="cursor: pointer">
                <a class="nav-link sub-menu-administrador" id="sub-{{$c->id}}">{{$c->nombre}}</a>
            </li>
    @endforeach
</ul>

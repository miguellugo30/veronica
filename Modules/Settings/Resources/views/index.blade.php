<li class="nav-item">
    <a class="nav-link" data-widget="pushmenu" href="#">
        <i class="fas fa-bars"></i>
        <span class="sr-only">Navegación de palanca</span>
    </a>
</li>
<ul class="navbar-nav mr-auto">
    @foreach ($categorias as $c)

        @if ( $c->Sub_Categorias->isEmpty() )
            <li class="nav-item" style="cursor: pointer">
                <a class="nav-link sub-menu-settings" id="sub-{{$c->id}}">{{$c->nombre}}</a>
            </li>
        @else
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{$c->nombre}}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @foreach ( $c->Sub_Categorias as $sc)
                        <a class="dropdown-item sub-menu-settings" style="cursor: pointer" id="sub-sub-{{$sc->id}}">{{$sc->nombre}}</a>
                    @endforeach
                </div>
            </li>
        @endif

    @endforeach
</ul>



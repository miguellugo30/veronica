<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Sidebar brand logo --}}
    @if(config('adminlte.logo_img_xl'))
        @include('adminlte::partials.common.brand-logo-xl')
    @else
        @include('adminlte::partials.common.brand-logo-xs')
    @endif

    {{-- Sidebar menu --}}
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

            <div class=" info" >
                <a class="text-white">{{ $agente->nombre }}</a><br>
                <a class="text-white">Usr.: {{ $agente->usuario }}</a><br>
                <a class="text-white">Ext.: {{ $agente->extension_real }}</a><br>
                @if ( $agenteEstado->Cat_Estado_Agente->nombre == 'Logueo' )
                    <a class="estado-agente text-white"><i class="fa fa-circle text-whute"></i> {{ $agenteEstado->Cat_Estado_Agente->nombre }}</a>
                @else
                    <a class="estado-agente text-white"><i class="fa fa-circle text-success"></i> {{ $agenteEstado->Cat_Estado_Agente->nombre }}</a>
                @endif
                <input type="hidden" name="id_agente" id="id_agente" value="{{$agente->id}}">
                <input type="hidden" name="extension" id="extension" value="{{$agente->extension}}">
                <input type="hidden" name="id_empresa" id="id_empresa" value="{{$agente->Empresas_id}}">
                @csrf
            </div>
        </div>
        <div class="col text-center">
            <div class="input-group">
                <input type="text" class="form-control form-control-sm" placeholder="Telefono" aria-label="Telefono" >
                <div class="input-group-append">
                    <span class="input-group-text bg-primary" id="basic-addon2"><i class="fas fa-phone text-white"></i></span>
                </div>
            </div>
            <br>
            <button type="button" class="btn btn-danger m-1 colgar-llamada" disabled><i class="fas fa-phone-slash"></i></button>
            <button type="button" class="btn btn-info m-1"><i class="fas fa-check"></i></button>
        </div>
        <hr class="bg-light">
        <div class="col text-center">
            <label class="text-white"><b>Opciones Avanzadas</b></label>
            <br>
            <button type="button" class="btn btn-primary m-1 transferir-llamada">
                <i class="fas fa-exchange-alt"></i>
            </button>
            <button type="button" class="btn btn-primary m-1 conferencia-llamada">
                <i class="fas fa-users"></i>
            </button>
        </div>
        <hr class="bg-light">
        <div class="col text-center">
            <label class="text-white"><b>No Disponible</b></label>
            <div class="input-group">
                <select name="no_disponible" id="no_disponible" class="form-control form-control-sm">
                    <option value="0">Selecciona una opcion</option>
                    @foreach ($eventosAgente as $evento)
                        <option value="{{$evento->id}}">{{$evento->nombre}}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <span class="input-group-text bg-primary activar_no_disponible" style="cursor:pointer" id="basic-addon2"><i class="fas fa-ban text-white"></i></span>
                </div>
            </div>
            <!--div class="input-group">
                <div class="input-group-prepend">
                    <div class="input-group-text btn-primary activar_no_disponible" style="cursor:pointer"><i class="fas fa-ban text-white"></i></div>
                </div>
            </div-->
        </div>
        <hr class="bg-light">
        @if ( isset( $modalidad->modalidad_logue ) )
            @if ( $modalidad->modalidad_logue == 'canal_abierto' )
                <div class="col">
                    <button type="button" class="logeo-extension btn btn-primary btn-sm btn-block"><i class="fas fa-phone"></i> Logueo en extension</button>
                </div>
            @endif
        @endif
        <br>
        <div class="col">
            <button type="button" class="btn btn-primary btn-sm btn-block"><i class="far fa-clock"></i> Llamada programada</button>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column {{ config('adminlte.classes_sidebar_nav', '') }}"
                data-widget="treeview" role="menu"
                @if(config('adminlte.sidebar_nav_animation_speed') != 300)
                    data-animation-speed="{{ config('adminlte.sidebar_nav_animation_speed') }}"
                @endif
                @if(!config('adminlte.sidebar_nav_accordion'))
                    data-accordion="false"
                @endif>
                {{-- Configured sidebar links --}}
                @each('adminlte::partials.sidebar.menu-item', $adminlte->menu('sidebar'), 'item')
            </ul>
        </nav>
    </div>

</aside>

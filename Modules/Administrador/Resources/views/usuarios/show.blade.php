<h5><b>Modulos</b></h5>
<div class="col">
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            @foreach( $modulos as $modulo )
                @if ($loop->first)
                    <li class="nav-item active"><a href="#tab_{{ Str::snake( $modulo->nombre ) }}" class="nav-link" data-toggle="tab">{{ $modulo->nombre }}</a></li>
                @else
                    <li class="nav-item"><a href="#tab_{{ Str::snake( $modulo->nombre ) }}" class="nav-link" data-toggle="tab">{{ $modulo->nombre }}</a></li>
                @endif
            @endforeach
        </ul>
        <div class="tab-content">
            @foreach( $modulos as $modulo )
                @if ($loop->first)
                    <div class="tab-pane active" id="tab_{{ Str::snake( $modulo->nombre ) }}">
                @else
                    <div class="tab-pane" id="tab_{{ Str::snake( $modulo->nombre ) }}">
                @endif
                        <h3>{{ $modulo->nombre }}</h3>
                        <table class="table table-bordered table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th></th>
                                    <th>Categoria</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($modulo->categorias as $categoria)
                                    <tr>
                                        <td><input type="checkbox" class="modulo" name="permisos[]" id="permisos[]" data-value="{{ $categoria->id }}" value="{{ $categoria->permiso }}"></td>
                                        <td>
                                            {{ $categoria->nombre }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" id="sub_cat_{{ $categoria->id }}" style="display:none">
                                            <div class="col" >
                                                <table class="table table-bordered table-sm">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Sub Categoria</th>
                                                            <th>Ver</th>
                                                            <th>Crear</th>
                                                            <th>Editar</th>
                                                            <th>Eliminar</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($categoria->Sub_Categorias as $sub)
                                                            <tr>
                                                                <td>{{ $sub->nombre }}</td>
                                                                @if ($sub->nombre == 'Logs')
                                                                        <td><input type="checkbox" name="permisos[]" id="permisos[]" value="{{ $sub->permiso }}"></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                    @else
                                                                        <td><input type="checkbox" name="permisos[]" id="permisos[]" value="{{ $sub->permiso }}"></td>
                                                                        <td><input type="checkbox" name="permisos[]" id="permisos[]" value="{{ str_replace( 'view', 'create',$sub->permiso) }}"></td>
                                                                        <td><input type="checkbox" name="permisos[]" id="permisos[]" value="{{ str_replace( 'view', 'edit',$sub->permiso) }}"></td>
                                                                        <td><input type="checkbox" name="permisos[]" id="permisos[]" value="{{ str_replace( 'view', 'delete',$sub->permiso) }}"></td>
                                                                    @endif
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                </div><!-- /.tab-pane -->
            @endforeach
        </div><!-- /.tab-content -->
    </div><!-- nav-tabs-custom -->
</div><!-- /.col -->

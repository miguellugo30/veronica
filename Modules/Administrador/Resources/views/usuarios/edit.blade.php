<div class="row">
    <div class="col-3">
        <fieldset>
            <legend>Información usuario</legend>
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control form-control-sm" id="name" placeholder="Nombre usuario" value="{{$user->name}}">
                <input type="hidden" class="form-control form-control-sm" id="id_user"  value="{{$user->id}}">
                @csrf
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control form-control-sm" id="email" placeholder="Email" value="{{$user->email}}">
            </div>
            <div class="form-group">
                <label for="pass_1">Contraseña</label>
                <input type="password" class="form-control form-control-sm" id="pass_1" placeholder="Contraseña" value="">
            </div>
            <div class="form-group">
                <label for="pass_2">Confirmar contraseña</label>
                <input type="password" class="form-control form-control-sm" id="pass_2" placeholder="Contraseña" value="">
            </div>
            <div class="form-group">
                <label for="cliente">Empresa</label>
                <select name="cliente" id="cliente" class="form-control form-control-sm">
                    <option value="">Selecciona una empresa</option>
                    <option value="30" {{ $user->id_cliente == 30 ? 'selected="selected"' : '' }}>C3NTRO</option>
                    @foreach( $clientes as $cliente )
                        <option value="{{ $cliente->id }}" {{ $user->id_cliente == $cliente->id ? 'selected="selected"' : '' }}>{{ $cliente->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="rol">Rol</label>
                @php
                    $role =  $user->getRoleNames();
                @endphp
                <select name="rol" id="rol" class="form-control form-control-sm">
                    <option value="">Selecciona un rol</option>
                    @foreach( $roles as $rol )
                        <option value="{{ $rol->id }}" {{ $role[0] == $rol->name ? 'selected="selected"' : '' }} >{{ $rol->name }}</option>
                    @endforeach
                </select>
            </div>
        </fieldset>
    </div>
    <div class="col modulosEmpresa">
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
                                            <td><input type="checkbox" class="modulo" name="permisos[]" id="permisos[]" data-value="{{ $categoria->id }}" value="{{ $categoria->permiso }}" {{ $user->hasPermissionTo( $categoria->permiso ) ? 'checked' : '' }}></td>
                                            <td>
                                                {{ $categoria->nombre }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" id="sub_cat_{{ $categoria->id }}" {{ $user->hasPermissionTo( $categoria->permiso ) ? 'style="display:"' : 'style="display:none"' }} >
                                                @if ( $categoria->Sub_Categorias->count() == 0 )

                                                    <table class="table table-bordered table-sm">
                                                        <thead class="thead-light">
                                                            <tr>
                                                                <th>Crear</th>
                                                                <th>Editar</th>
                                                                <th>Eliminar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td><input type="checkbox" name="permisos[]" id="permisos[]" {{ $user->hasPermissionTo( str_replace( 'view', 'create', $categoria->permiso) ) ? 'checked' : '' }} value="{{ str_replace( 'view', 'create',$categoria->permiso) }}"></td>
                                                                <td><input type="checkbox" name="permisos[]" id="permisos[]" {{ $user->hasPermissionTo( str_replace( 'view', 'edit', $categoria->permiso) ) ? 'checked' : '' }} value="{{ str_replace( 'view', 'edit',$categoria->permiso) }}"></td>
                                                                <td><input type="checkbox" name="permisos[]" id="permisos[]" {{ $user->hasPermissionTo( str_replace( 'view', 'delete', $categoria->permiso) ) ? 'checked' : '' }} value="{{ str_replace( 'view', 'delete',$categoria->permiso) }}"></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                @else

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
                                                                            <td><input type="checkbox" name="permisos[]" id="permisos[]" {{ $user->hasPermissionTo( $sub->permiso ) ? 'checked' : '' }} value="{{ $sub->permiso }}"></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                        @else
                                                                            <td><input type="checkbox" name="permisos[]" id="permisos[]" {{ $user->hasPermissionTo( $sub->permiso ) ? 'checked' : '' }} value="{{ $sub->permiso }}"></td>
                                                                            <td><input type="checkbox" name="permisos[]" id="permisos[]" {{ $user->hasPermissionTo( str_replace( 'view', 'create',$sub->permiso) ) ? 'checked' : '' }} value="{{ str_replace( 'view', 'create',$sub->permiso) }}"></td>
                                                                            <td><input type="checkbox" name="permisos[]" id="permisos[]" {{ $user->hasPermissionTo( str_replace( 'view', 'edit',$sub->permiso) ) ? 'checked' : '' }} value="{{ str_replace( 'view', 'edit',$sub->permiso) }}"></td>
                                                                            <td><input type="checkbox" name="permisos[]" id="permisos[]" {{ $user->hasPermissionTo( str_replace( 'view', 'delete',$sub->permiso) ) ? 'checked' : '' }} value="{{ str_replace( 'view', 'delete',$sub->permiso) }}"></td>
                                                                        @endif
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                @endif

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
    </div>
</div>

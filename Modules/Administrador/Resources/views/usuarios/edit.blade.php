<div class="col-md-6">
    <fieldset>
        <legend>Información usuario</legend>
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control input-sm" id="name" placeholder="Nombre usuario" value="{{$user->name}}">
            <input type="hidden" class="form-control input-sm" id="id_user"  value="{{$user->id}}">
            @csrf
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control input-sm" id="email" placeholder="Email" value="{{$user->email}}">
        </div>
        <div class="form-group">
            <label for="pass_1">Contraseña</label>
            <input type="password" class="form-control input-sm" id="pass_1" placeholder="Contraseña" value="">
        </div>
        <div class="form-group">
            <label for="pass_2">Confirmar contraseña</label>
            <input type="password" class="form-control input-sm" id="pass_2" placeholder="Contraseña" value="">
        </div>
        <div class="form-group">
            <label for="cliente">Empresa</label>
            <select name="cliente" id="cliente" class="form-control input-sm">
                <option value="">Selecciona una empresa</option>
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
            <select name="rol" id="rol" class="form-control input-sm">
                <option value="">Selecciona un rol</option>
                @foreach( $roles as $rol )
                    <option value="{{ $rol->id }}" {{ $role[0] == $rol->name ? 'selected="selected"' : '' }} >{{ $rol->name }}</option>
                @endforeach
            </select>
        </div>
    </fieldset>
</div>
<div class="col-md-6">
    <fieldset>
        <legend>Categorías</legend>
        @foreach( $categorias as $categoria )
        <div class="checkbox">
            <label>
                <input type="checkbox" name="cats[]" value="{{ $categoria->id }}" {{ in_array( $categoria->id, $catUser ) ? 'checked="checked"' : '' }}>
                {{ $categoria->nombre }}
            </label>
        </div>
        @endforeach
    </fieldset>
</div>
<div class="col-md-12" style="text-align:center">
    <div class="col-md-6" style="text-align:left">
        <button type="submit" class="btn btn-warning btn-sm cancelClient"><i class="fas fa-times"></i> Cancelar</button>
        <button type="submit" class="btn btn-danger btn-sm deleteClient"><i class="fas fa-trash-alt"></i> Eliminar</button>
    </div>
    <div class="col-md-6" style="text-align:right">
        <button type="submit" class="btn btn-primary btn-sm updateClient"><i class="fas fa-save"></i> Guardar</button>
    </div>
</div>

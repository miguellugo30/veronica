<div class="col-md-6">
    <fieldset>
        <legend>
            <i class="fas fa-user"></i>
            Información usuario
        </legend>
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control input-sm" id="name" placeholder="Nombre usuario">
            @csrf
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control input-sm" id="email" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="pass_1">Contraseña</label>
            <input type="password" class="form-control input-sm" id="pass_1" placeholder="Contraseña">
        </div>
        <div class="form-group">
            <label for="pass_2">Confirmar contraseña</label>
            <input type="password" class="form-control input-sm" id="pass_2" placeholder="Contraseña">
        </div>
        <div class="form-group">
            <label for="cliente">Empresa</label>
            <select name="cliente" id="cliente" class="form-control input-sm">
                <option value="">Selecciona una empresa</option>
                @foreach( $clientes as $cliente )
                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="rol">Roles</label>
            <select name="rol" id="rol" class="form-control input-sm">
                <option value="">Selecciona un rol</option>
                @foreach( $roles as $rol )
                    <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                @endforeach
            </select>
        </div>
    </fieldset>
</div>
<div class="col-md-6">
    <fieldset >
        <legend>Categorias</legend>
        @foreach( $categorias as $categoria )
        <div class="checkbox">
            <label>
                <input type="checkbox" name="cats[]" value="{{ $categoria->id }}">
                {{ $categoria->nombre }}
            </label>
        </div>
        @endforeach
    </fieldset>
</div>
<div class="col-md-12" style="text-align:center">
    <div class="col-md-6" style="text-align:left">
        <button type="submit" class="btn btn-warning btn-sm cancelClient"><i class="fas fa-times"></i> Cancelar</button>
    </div>
    <div class="col-md-6" style="text-align:right">
        <button type="submit" class="btn btn-primary btn-sm saveClient"><i class="fas fa-save"></i> Guardar</button>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control form-control-sm" id="name" placeholder="Nombre usuario">
            @csrf
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control form-control-sm" id="email" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="pass_1">Contraseña</label>
            <input type="password" class="form-control form-control-sm" id="pass_1" placeholder="Contraseña">
        </div>
        <div class="form-group">
            <label for="pass_2">Confirmar contraseña</label>
            <input type="password" class="form-control form-control-sm" id="pass_2" placeholder="Contraseña">
        </div>
        <div class="form-group">
            <label for="cliente">Empresa</label>
            <select name="cliente" id="cliente" class="form-control form-control-sm">
                <option value="">Selecciona una empresa</option>
                @foreach( $clientes as $cliente )
                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="rol">Roles</label>
            <select name="rol" id="rol" class="form-control form-control-sm">
                <option value="">Selecciona un rol</option>
                @foreach( $roles as $rol )
                    <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col">
        <fieldset>
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
</div>

<!--div class="col-12" style="text-align:center">
    <button type="submit" class="btn btn-warning btn-sm cancelClient float-left"><i class="fas fa-times"></i> Cancelar</button>
    <button type="submit" class="btn btn-primary btn-sm saveClient float-right"><i class="fas fa-save"></i> Guardar</button>
</div-->

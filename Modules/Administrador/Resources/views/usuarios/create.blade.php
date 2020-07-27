<div class="row">
    <div class="col-3">
        <div class="form-group">
            <label for="name">Nombre *:</label>
            <input type="text" class="form-control form-control-sm" id="name" placeholder="Nombre usuario">
            @csrf
        </div>
        <div class="form-group">
            <label for="email">Email *:</label>
            <input type="text" class="form-control form-control-sm" id="email" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="pass_1">Contraseña *:</label>
            <input type="password" class="form-control form-control-sm" id="pass_1" placeholder="Contraseña">
        </div>
        <div class="form-group">
            <label for="pass_2">Confirmar contraseña *:</label>
            <input type="password" class="form-control form-control-sm" id="pass_2" placeholder="Contraseña">
        </div>
        <div class="form-group">
            <label for="cliente">Empresa *:</label>
            <select name="cliente" id="cliente" class="form-control form-control-sm">
                <option value="">Selecciona una empresa</option>
                <option value="1">Veronica</option>
                @foreach( $clientes as $cliente )
                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="rol">Roles *:</label>
            <select name="rol" id="rol" class="form-control form-control-sm">
                <option value="">Selecciona un rol</option>
                @foreach( $roles as $rol )
                    <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <small class="form-text text-muted"> <b>*Campos obligatorios.</b></small>
        </div>
        <div class="alert alert-danger print-error-msg" role="alert" style="display:none">
            <ul></ul>
        </div>
    </div>
    <div class="col modulosEmpresa">

    </div>
</div>

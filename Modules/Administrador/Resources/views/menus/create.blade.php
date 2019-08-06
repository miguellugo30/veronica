<div class="col-12" style="float:none; margin:auto">
    <div class="form-group">
        <label for="tipo_id"><b>Tipo</b></label>
        <select name="tipo_id" id="tipo_id" class="form-control form-control-sm">
            <option value="">Selecciona un tipo</option>
            <option value="1">Menu</option>
            <option value="2">Sub-Menu</option>
        </select>
    </div>
    <div class="form-group selectModulo"  style="display:none">
        <label for="modulo_id"><b>Modulo</b></label>
        <select name="modulo_id" id="modulo_id" class="form-control form-control-sm">
            <option value="">Selecciona un modulo</option>
            @foreach( $modulos as $modulo )
                <option value="{{ $modulo->id }}">{{ $modulo->nombre }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group selectMenu" style="display:none">
        <label for="menu_id"><b>Menu</b></label>
        <select name="menu_id" id="menu_id" class="form-control form-control-sm">
            <option value="">Selecciona un menu</option>
            @foreach( $categorias as $categoria )
                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="name"><b>Nombre</b></label>
        <input type="text" class="form-control form-control-sm" id="nombre" placeholder="Nombre">
        @csrf
    </div>
    <div class="form-group">
        <label for="email"><b>Descripción</b></label>
        <input type="text" class="form-control form-control-sm" id="descripcion" placeholder="Descripcion">
    </div>
    <div class="form-group">
        <label for="nivel_id"><b>Nivel</b></label>
        <select name="nivel_id" id="nivel_id" class="form-control form-control-sm">
            <option value="">Selecciona un nivel</option>
            <option value="1">Sistema</option>
            <option value="2">Cliente</option>
        </select>
    </div>
</div>
<!--div class="col-6" style="float:none; margin:auto">
    <button type="submit" class="btn btn-warning btn-sm cancelMenu"><i class="fas fa-times"></i> Cancelar</button>
    <button type="submit" class="btn btn-primary btn-sm saveMenu float-right"><i class="fas fa-save"></i> Guardar</button>
</div-->

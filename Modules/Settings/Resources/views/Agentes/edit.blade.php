<div class="">
    <form enctype="multipart/form-data" id="formDataAgente" method="post">
        <div class="col">
            <fieldset>
               
                <div class="form-group">
                    <label for="grupo">Grupo</label>
                    <input type="text" class="form-control form-control-sm" name="grupo" id="grupo"  value="">
                    <input type="hidden" name="id" id="id"  value="{{$agente->id}}">
                    @csrf
                </div>
                <div class="form-group">
                    <label for="nivel">Nivel</label>
                    <input type="text" class="form-control form-control-sm" name="nivel" id="nivel"  value="">
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control form-control-sm" name="nombre" id="nombre"  value="{{$agente->nombre}}">
                </div>
                <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input type="text" class="form-control form-control-sm" name="usuario" id="usuario"  value="{{$agente->usuario}}">
                </div>
                <div class="form-group">
                    <label for="contrasena">Contraseña</label>
                    <input type="text" class="form-control form-control-sm" name="contrasena" id="contrasena"  value="{{$agente->contrasena}}">
                </div>
                <div class="form-group">
                    <label for="extension">Extensión</label>
                    <input type="text" class="form-control form-control-sm" name="extension" id="extension"  value="{{$agente->extension}}">
                </div>
                <div class="form-group">
                    <label for="protocolo">Protocolo</label>
                    <input type="text" class="form-control form-control-sm" name="protocolo" id="protocolo"  value="">
                </div>
            </fieldset>
        </div>
        <div class="col">
    </form>
</div>

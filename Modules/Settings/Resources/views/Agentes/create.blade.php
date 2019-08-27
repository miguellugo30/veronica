<div >
    <form enctype="multipart/form-data" id="altaagente" method="post">
        <div class="col">
            <fieldset>
            <div class="form-group">
                    <label for="grupo">Grupo</label>
                    <input type="text" class="form-control form-control-sm" name="grupo" id="grupo"  value="">
                    <input type="hidden" name="Cat_Estado_Agente_id" id="Cat_Estado_Agente_id"  value="1">

                    @csrf
                </div>
                <div class="form-group">
                    <label for="nivel">Nivel</label>
                    <input type="text" class="form-control form-control-sm" name="nivel" id="nivel"  value="">
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control form-control-sm" name="nombre" id="nombre"  value="">
                </div>
                <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input type="text" class="form-control form-control-sm" name="usuario" id="usuario"  value="">
                </div>
                <div class="form-group">
                    <label for="contrasena">Contraseña</label>
                    <input type="text" class="form-control form-control-sm" name="contrasena" id="contrasena"  value="">
                </div>
                <div class="form-group">
                    <label for="extension">Extensión</label>
                    <input type="text" class="form-control form-control-sm" name="extension" id="extension"  value="">
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
<!-- CARGA AUDIOS -->
<form enctype="multipart/form-data" id="altaaudio" method="post">
    <div class="col">
        <fieldset>
            <div class="alert alert-dark" role="alert" style="height: 30px;padding: .3rem 1.25rem;">
            Cargar Sonido/Grabación (Mono,8000 Hz,16 bit)
            </div>
            <div class="form-group">
                <label for="nombre">Nombre De La Grabación *:</label>
                <input type="text" class="form-control form-control-sm" id="nombre"  value="">
                @csrf
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción *:</label>
                <input type="text" class="form-control form-control-sm" id="descripcion"  value="">
            </div>

            <!-- CARGA DEL ARCHIVO -->
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input form-control-sm" id="file" name="file" lang="es">
                    <label class="custom-file-label" id='labelFile' for="file">Seleccionar Archivo .WAV *:</label>
                </div>
            </div>
            <div class="form-group">
                <small class="form-text text-muted"> <b>*Campos obligatorios.</b></small>
            </div>
            <div class="alert alert-danger print-error-msg" role="alert" style="display:none">
                <ul></ul>
            </div>
        </fieldset>
    </div>
</form>

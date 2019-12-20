<div >
    <form enctype="multipart/form-data" id="altaevento" method="post">
        <div class="col">
            <fieldset>
            <div class="form-group">
                    <label for="nombre">Evento *:</label>
                    <input type="text" class="form-control form-control-sm" name="nombre" id="nombre"  value="">

                    @csrf
                </div>
                <div class="form-group">
                    <label for="tiempo">Tiempo (Minutos) *:</label>
                    <input type="number" min="1" max="60" class="form-control form-control-sm" name="tiempo" id="tiempo"  value="1">
                </div>
                <div class="form-group">
                    <small class="form-text text-muted"> <b>*Campos obligatorios.</b></small>
                </div>
                <div class="alert alert-danger print-error-msg" role="alert" style="display:none">
                    <ul></ul>
                </div>
            </fieldset>
        </div>
        <div class="col">

    </form>
</div>

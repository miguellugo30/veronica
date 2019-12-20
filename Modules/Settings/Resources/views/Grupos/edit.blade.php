<div >
    <form enctype="multipart/form-data" id="formDataGruos" method="post">
        <div class="col">
            <fieldset>
            <div class="form-group">
                    <label for="nombre">Nombre *:</label>
                    <input type="text" class="form-control form-control-sm" name="nombre" id="nombre"  value="{{$grupo->nombre}}">
                    <input type="hidden" name="id" id="id"  value="{{$grupo->id}}">
                    @csrf
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción *:</label>
                    <input type="text" class="form-control form-control-sm" name="descripcion" id="descripcion"  value="{{$grupo->descripcion}}">
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

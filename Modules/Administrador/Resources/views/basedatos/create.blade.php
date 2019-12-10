<div class="col-12" style="float:none; margin:auto">
    <div class="form-group">
        <label for="name"><b>Nombre *:</b></label>
        <input type="text" class="form-control form-control-sm" id="nombre" placeholder="Nombre">
        @csrf
    </div>
    <div class="form-group">
        <label for="ubicacion"><b>Ubicación *:</b></label>
        <input type="text" class="form-control form-control-sm" id="ubicacion" placeholder="Ubicacion">
    </div>
    <div class="form-group">
        <label for="ip"><b>IP *:</b></label>
        <input type="text" class="form-control form-control-sm" id="ip" placeholder="IP">
    </div>
    <div class="form-group">
        <small class="form-text text-muted"> <b>*Campos obligatorios.</b></small>
    </div>
</div>

<div class="alert alert-danger print-error-msg" role="alert" style="display:none">
    <ul></ul>
</div>

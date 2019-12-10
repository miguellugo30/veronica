<div class="col-12" style="float:none; margin:auto">
    <div class="form-group">
        <label for="name"><b>Nombre *:</b></label>
        <input type="text" class="form-control form-control-sm" id="nombre" placeholder="Nombre" value="{{ $cat_nas->nombre }}">
        <input type="hidden" name="id" id="id" value="{{ $id }}">
        @csrf
    </div>
    <div class="form-group">
        <label for="ip_nas"><b>IP NAS *:</b></label>
        <input type="text" class="form-control form-control-sm" id="ip_nas" placeholder="IP NAS" value="{{ $cat_nas->ip_nas }}">
        @csrf
    </div>
    <div class="form-group">
        <small class="form-text text-muted"> <b>*Campos obligatorios.</b></small>
    </div>
</div>
<div class="alert alert-danger print-error-msg" role="alert" style="display:none">
    <ul></ul>
</div>

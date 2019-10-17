<input type="hidden" id="id_sansay" name="id_sansay" value="{{ $configuracion[0]->id }}">
<dl class="row">
    @csrf
    <dt class="col-sm-3">type =</dt>
    <dd class="col-sm-9">{{ $configuracion[0]->type }}</dd>
    <dt class="col-sm-3">host =</dt>
    <dd class="col-sm-9"><input type="text" class="form-control form-control-sm" id="host" name="host" value="{{ $configuracion[0]->host }}"></dd>
    <dt class="col-sm-3">context =</dt>
    <dd class="col-sm-9">{{ $configuracion[0]->context }}</dd>
    <dt class="col-sm-3">dtmfmode =</dt>
    <dd class="col-sm-9"><input type="text" class="form-control form-control-sm" id="dtmfmode" name="dtmfmode" value="{{ $configuracion[0]->dtmfmode }}"><dd>
    <dt class="col-sm-3">directmedia =</dt>
    <dd class="col-sm-9">{{ $configuracion[0]->directmedia }}</dd>
    <dt class="col-sm-3">canreinvite =</dt>
    <dd class="col-sm-9">{{ $configuracion[0]->canreinvite }}</dd>
    <dt class="col-sm-3">disallow =<dt>
    <dd class="col-sm-9">{{ $configuracion[0]->disallow }}</dd>
    <dt class="col-sm-3">allow =<dt>
    <dd class="col-sm-9"><input type="text" class="form-control form-control-sm" id="allow" name="allow" value="{{ $configuracion[0]->allow }}"></dd>
    <dt class="col-sm-3">qualify =<dt>
    <dd class="col-sm-9">{{ $configuracion[0]->qualify }}</dd>
</dl>

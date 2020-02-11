<div class="col-12" style="float:none; margin:auto">
    <div class="form-group">
        <label for="name">Nombre *:</label>
        <input type="text" class="form-control form-control-sm" id="nombre" placeholder="Nombre" value="{{ $cat_campos_plantillas->nombre }}">
        <input type="hidden" name="id" id="id" value="{{ $id }}">
        @csrf
    </div>
    <label for="empresa">Selecciona la(s) Empresa(s)</label>
        <div class="form-row col-md-12">
            <div class="col-md-5">
                <select name="empresa" id="empresa" class="form-control form-control-sm" multiple>
                    @foreach( $Empresas2 as $empresa2 )
                    <option value="{{ $empresa2->id }}">{{ $empresa2->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <input type="button" class="form-control form-control-sm btnRight" id="btnRight" value="&gt;&gt;">
                <input type="button" class="form-control form-control-sm btnLeft" id="btnLeft" value="&lt;&lt;">
            </div>
            <div class="col-md-5">
                <select name="empresaAdd" id="empresaAdd" class="form-control form-control-sm" multiple>
                    @foreach( $Empresas as $empresa )
                    <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    <div class="form-group">
        <small class="form-text text-muted"> <b>*Campos obligatorios.</b></small>
    </div>
    <div class="alert alert-danger print-error-msg" role="alert" style="display:none">
        <ul></ul>
    </div>
</div>

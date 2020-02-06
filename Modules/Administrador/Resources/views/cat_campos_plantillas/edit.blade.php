<div class="col-12" style="float:none; margin:auto">
    <div class="form-group">
        <label for="name">Nombre *:</label>
        <input type="text" class="form-control form-control-sm" id="nombre" placeholder="Nombre" value="{{ $cat_campos_plantillas->nombre }}">
        <input type="hidden" name="id" id="id" value="{{ $id }}">
        @csrf
    </div>
    <div class="form-group">
        <label for="empresa">Empresa *:</label>
        <select name="empresa" id="empresa" class="form-control form-control-sm">
            <option value="" >Selecciona una Empresa</option>
            @foreach( $Empresas as $empresa )
                @foreach($cat_campos_plantillas->Empresas as $emp)
                    <option value="{{ $empresa->id }}" {{ $empresa->id == $emp->id ? 'selected' : ''}}>{{ $empresa->nombre }}</option>
                @endforeach
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <small class="form-text text-muted"> <b>*Campos obligatorios.</b></small>
    </div>
    <div class="alert alert-danger print-error-msg" role="alert" style="display:none">
        <ul></ul>
    </div>
</div>

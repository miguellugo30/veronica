<div class="col">
    <fieldset>
        <div class="form-group">
                <label for="nombre"><b>Nombre *:</b></label>
            <input type="text" class="form-control form-control-sm" id="nombre"  placeholder="Nombre" value="{{$desvios->nombre}}">
            <input type="hidden" class="form-control form-control-sm" id="Empresas_id"  value="{{$empresa_id}}">
            <input type="hidden" name="id" id="id"  value="{{$desvios->id}}">

            @csrf
        </div>
        <div class="form-group">
            <label for="Canales_id"><b>Canal *:</b></label>
            <select name="Canales_id" id="Canales_id" class="form-control form-control-sm">
                <option value="">Selecciona una opción</option>
                @foreach ($canales as $canal)
                    <option value="{{$canal->id}}" {{($canal->id == $desvios->Canales_id) ? 'selected = "selected"':'' }} >{{$canal->Cat_Tipo_Canales->nombre}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="dial"><b>Destino *:</b></label>
            <input type="text" class="form-control form-control-sm" id="dial"  value="{{$desvios->dial}}">
        </div>
        <div class="form-group">
            <label for="ringeo"><b>Tiempo De Ringeo *:</b></label>
            <input type="number" min="10" class="form-control form-control-sm" id="ringeo"  value="{{$desvios->ringeo}}">
        </div>
        <div class="form-group text-right">
            <b>* Campos obligatorios.</b>
        </div>
    </fieldset>
    <div class="alert alert-danger print-error-msg" role="alert" style="display:none">
        <ul></ul>
    </div>
</div>

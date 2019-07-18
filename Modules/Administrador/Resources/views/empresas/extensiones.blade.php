<fieldset>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="form-group">
            <label for="canal_id">Canal</label>
            <select name="canal_id" id="canal_id" class="form-control input-sm">
                <option value="" >Selecciona un canal</option>
                @foreach ($canales as $canal)
                    <option value="{{$canal->id}}">{{ $canal->protocolo }}{{ $canal->Troncales->nombre }}/{{ $canal->prefijo }}</option>
                @endforeach
            </select>
            <input type="hidden" name="id_empresa" id="id_empresa" value="{{ $idEmpresa }}">
            <input type="hidden" name="action" id="action" value="dataExtensiones">
            @csrf
        </div>
        <div class="form-group">
            <label for="">Rango de extensiones</label>
            <div class="form-inline" style="text-align:center">
                <div class="form-group">
                    <label for="extension">Extension</label>
                    <input type="number" min="1" class="form-control" id="extension" name="extension" placeholder="Extension">
                </div>
                <div class="form-group">
                    <label for="posiciones">Numero de posiciones</label>
                    <input type="number" min="1" max="99" class="form-control" id="posiciones" name="posiciones" placeholder="Num. Posiciones">
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
</fieldset>

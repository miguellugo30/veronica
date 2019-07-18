<fieldset>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="form-group">
            <label for="base_datos_empresa">Canal</label>
            <select name="base_datos_empresa" id="base_datos_empresa" class="form-control input-sm">
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
            <label for="base_datos_empresa">Rango de extensiones</label>
            <div class="form-inline" style="text-align:center">
                <div class="form-group">
                    <label for="exampleInputName2">Inicio</label>
                    <input type="number" min="1" class="form-control" id="inicioExtension" placeholder="Incio">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail2">Fin</label>
                    <input type="number" min="1" class="form-control" id="finExtension" placeholder="Fin">
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
</fieldset>

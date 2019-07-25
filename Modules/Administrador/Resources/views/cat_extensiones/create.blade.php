<div class="col-md-12">
    <input type="hidden" name="id_empresa" id="id_empresa" value="{{ $id }}">
    <input type="hidden" name="action" id="action" value="dataExtensiones">
    @csrf
    <div class="form-group">
        <label for="canal_id">Canal</label>
        <select name="canal_id" id="canal_id" class="form-control input-sm">
            <option value="" >Selecciona un canal</option>
            @foreach ($canales as $canal)
                <option value="{{$canal->id}}">{{ $canal->protocolo }}{{ $canal->Troncales->nombre }}/{{ $canal->prefijo }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="">Extensiones
        </label>
        <div class="form-inline" style="text-align:center">
            <div class="form-group">
                <label for="extension">Extension:</label>
                <input type="number" min="1" class="form-control" id="extension" name="extension" placeholder="Extension">
            </div>
            <div class="form-group">
                <label for="posiciones">Posiciones:</label>
                <input type="number" class="form-control" min="1" max="{{ $numExtensiones - $extCreadas }}" id="posiciones" name="posiciones" value="{{ $numExtensiones - $extCreadas }}">
            </div>
        </div>
    </div>
</div>
<div class="col-md-12" style="padding:10px;">
    <div class="col-md-6" style="text-align:left">
        <!--button type="submit" class="btn btn-warning cancelExtension"><i class="fas fa-times"></i> Cancelar</button-->
    </div>
    <div class="col-md-6" style="text-align:right">
        <button type="submit" class="btn btn-primary saveExtension"><i class="fas fa-save"></i> Guardar</button>
    </div>
</div>

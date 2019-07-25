<div class="col-md-12">
    @csrf
    <input type="hidden" name="id_empresa" id="id_empresa" value="{{ $id }}">
    <input type="hidden" name="action" id="action" value="dataDids">
    <!-- Mostrando los canales de la empresa seleccionada -->
    <div class="form-group">
        <label for="Canal_id">Canal</label>
        <select name="Canal_id" id="Canal_id" class="form-control">
            <option value="">Selecciona un canal</option>
            @foreach ($canales as $canal)
            <option value="{{$canal->id}}">{{ $canal->protocolo.$canal->Troncales->nombre."/".$canal->prefijo }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <!-- Agregar los nuevos dids -->
        <label for="did">Did</label>
        <textarea class="form-control" style="resize:none;" rows="10" id="did" name="did" placeholder="Ingresa la lista de prefijos en esta area separados por enter."></textarea>
    </div>
    <div class="form-group">
        <!-- Agregar la referencia -->
        <label for="referencia">Referencia</label>
        <input type="text" class="form-control" id="referencia" name="referencia" placeholder="Referencia"/>
    </div>
    <div class="form-group">
        <!-- Agregar numero real -->
        <label for="numero_real">Numero Real</label>
        <input type="text" class="form-control" id="numero_real" name="numero_real" placeholder="Numero Real"/>
    </div>
    <div class="form-group">
        <label for="gateway">Gateway</label><br>
        <label class="radio-inline">
            <input type="radio" id="gateway" name="gateway" value="1" > Habilitado
        </label>
        <label class="radio-inline">
            <input type="radio" id="gateway" name="gateway" value="0" > Deshabilitado
        </label>
    </div>
    <div class="form-group">
        <label for="fakedid">Fakedid</label><br>
        <label class="radio-inline">
            <input type="radio" name="fakedid" id="fakedid" value="1" > Habilitado
        </label>
        <label class="radio-inline">
            <input type="radio" name="fakedid" id="fakedid" value="0" checked> Deshabilitado
        </label>
    </div>
</div>
<div class="col-md-12" style="padding:10px;">
    <div class="col-md-6" style="text-align:left">
        <!--button type="submit" class="btn btn-warning cancelExtension"><i class="fas fa-times"></i> Cancelar</button-->
    </div>
    <div class="col-md-6" style="text-align:right">
        <button type="submit" class="btn btn-primary saveDid"><i class="fas fa-save"></i> Guardar</button>
    </div>
</div>

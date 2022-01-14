
<div class="col-md-6" style="float:none; margin:auto">
    <div class="form-group">

        @csrf
        <input type="hidden" name="id" id="id" value="{{ $Dids->id }}">
    </div>
    <input type="hidden" class="form-control" id="id_did" value="{{$Dids->id}}"/>
    <!-- Esta variable genera un token Laravel se debe colocar en el form -->

    <label for="Canal_id">Canal</label>
    <select name="Canal_id" id="Canal_id" class="form-control form-control-sm">
    <option value="">Selecciona un canal</option>
        @foreach( $canales as $canal )
            <option value="{{ $canal->id }}" {{ ( $Dids->Canales->id == $canal->id )  ? 'selected="selected"' : '' }}>{{ $canal->protocolo.$canal->Troncales->nombre."/".$canal->prefijo }}</option>
        @endforeach
    </select>
    <div class="form-group">
        <label for="did">Did</label>
        <input  value="{{$Dids->did}}" type="text" class="form-control form-control-sm" id="did" placeholder="Did"/>
    </div>
    <div class="form-group">
        <label for="referencia">Referencia</label>
        <input  value="{{$Dids->referencia}}" type="text" class="form-control form-control-sm" id="referencia" placeholder="Referencia"/>
    </div>
    <div class="form-group">
        <label for="numero_real">Numero Real</label>
        <input value="{{$Dids->numero_real}}" type="text" class="form-control form-control-sm" id="numero_real" placeholder="Numero Real"/>
    </div>
    <div class="form-group">
        <label for="gateway">Gateway</label>
        <br>
        <br>
        <label class="radio-inline">
            <input type="radio" name="gateway" id="gateway" value="1" {{ $Dids->gateway == 1 ? 'checked' : '' }}> Habilitado
        </label>
        <label class="radio-inline">
            <input type="radio" name="gateway" id="gateway" value="0"  {{ $Dids->gateway == 0 ? 'checked' : '' }}> Deshabilitado
        </label>
    </div>
    <div class="form-group">
        <label for="fakedid">Fakedid</label>
        <br>
        <br>
        <label class="radio-inline">
            <input type="radio" name="fakedid" id="fakedid" value="1" {{ $Dids->fakedid == 1 ? 'checked' : '' }}> Habilitado
        </label>
        <label class="radio-inline">
            <input type="radio" name="fakedid" id="fakedid" value="0" {{ $Dids->fakedid == 0 ? 'checked' : '' }}> Deshabilitado
        </label>
    </div>
</div>

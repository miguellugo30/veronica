<fieldset>
	<legend>
		<i class="fas fa-truck"></i>
		Modificar Did
	</legend>
	<div class="col-md-6" style="float:none; margin:auto">
            <div class="form-group">
                <label for="id_empresa">Empresa</label>
                <select name="id_empresa" id="id_empresa" class="form-control">
                    <option value="">Selecciona una empresa</option>
                        @foreach( $empresas as $empresa )
                            <option value="{{ $empresa->id }}" {{ ( $Dids->Empresas->id == $empresa->id )  ? 'selected="selected"' : '' }}>{{ $empresa->nombre }}</option>
                        @endforeach
                </select>
                @csrf
                <input type="hidden" name="id" id="id" value="{{ $Dids->id }}">
            </div>
            <input type="hidden" class="form-control" id="id_did" value="{{$Dids->id}}"/>
            <!-- Esta variable genera un token Laravel se debe colocar en el form -->

            <label for="Canal_id">Canal</label>
            <select name="Canal_id" id="Canal_id" class="form-control">
            <option value="{{$Dids->Canales->canal}}">Selecciona un canal</option>
                @foreach( $canales as $canal )
                    <option value="{{ $canal->id }}" {{ ( $Dids->Canales->id == $canal->id )  ? 'selected="selected"' : '' }}>{{ $canal->canal }}</option>
                @endforeach
            </select>
            <div class="form-group">
                <label for="prefijo">Prefijo</label>
                <input  value="{{$Dids->prefijo}}" type="text" class="form-control" id="prefijo" placeholder="Prefijo"/>
            </div>
            <div class="form-group">
                <label for="did">Did</label>
                <input  value="{{$Dids->did}}" type="text" class="form-control" id="did" placeholder="Did"/>
            </div>
            <div class="form-group">
                <label for="referencia">Referencia</label>
                <input  value="{{$Dids->referencia}}" type="text" class="form-control" id="referencia" placeholder="Referencia"/>
            </div>
            <div class="form-group">
                <label for="numero_real">Numero Real</label>
                <input value="{{$Dids->numero_real}}" type="text" class="form-control" id="numero_real" placeholder="Numero Real"/>
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
        <div class="col-md-6" style="float:none; margin:auto">
            <div class="col-md-4" style="text-align:left">
                <button type="submit" class="btn btn-danger deleteDid"><i class="fas fa-trash-alt"></i> Eliminar </button>
            </div>
            <div class="col-md-4" style="text-align:center">
                <button type="submit" class="btn btn-warning cancelDid"><i class="fas fa-times"></i> Cancelar</button>
            </div>
            <div class="col-md-4" style="text-align:right">
                <button type="submit" class="btn btn-primary updateDid"><i class="fas fa-save"></i> Guardar</button>
            </div>
		</div>
	<br/>
	<br/>
</fieldset>

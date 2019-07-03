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
            </div>
            <input type="hidden" class="form-control" id="id_did" value="{{$Dids->id}}"/>
            <!-- Esta variable genera un token Laravel se debe colocar en el form -->
            @csrf
            <div class="form-group">
                <label for="tipo">Tipo</label>
                <select name="tipo" id="tipo" class="form-control">
                    <option value="">Selecciona un tipo</option>
                    <option value="1" {{ $Dids->tipo == 1 ? 'selected="selected"' : '' }}>Did</option>
                    <option value="2" {{ $Dids->tipo == 2 ? 'selected="selected"' : '' }}>Analogo</option>
                </select>
            </div>
            <div class="form-group">
                <label for="prefijo">Prefijo</label>
                <input  value="{{$Dids->prefijo}}" type="text" class="form-control" id="prefijo" placeholder="Prefijo"/>
            </div>
            <div class="form-group">
                <label for="did">Did</label>
                <input  value="{{$Dids->did}}" type="text" class="form-control" id="did" placeholder="Did"/>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripcion</label>
                <input  value="{{$Dids->descripcion}}" type="text" class="form-control" id="descripcion" placeholder="Descripcion"/>
            </div>
            <div class="form-group showTroncales">
                <label for="Troncales_id">Troncal</label>
                <select name="Troncales_id" id="Troncales_id" class="form-control">
                    <option value="">Selecciona una troncal</option>
                    @foreach( $troncales as $troncal )
                        <option value="{{ $troncal->id }}" {{ ( $Dids->Troncales->id == $troncal->id )  ? 'selected="selected"' : '' }}>{{ $troncal->nombre }}</option>
                    @endforeach
                </select>
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
        <div class="col-md-12">
            <div class="col-md-6" style="float:none; margin:auto">
                <div class="col-md-6" style="text-align:left">
                    <button type="submit" class="btn btn-danger deleteDid"><i class="fas fa-trash-alt"></i> Eliminar </button>
                    <button type="submit" class="btn btn-warning cancelDid"><i class="fas fa-times"></i> Cancelar</button>
                </div>
                <div class="col-md-6" style="text-align:right">
                    <button type="submit" class="btn btn-primary updateDid"><i class="fas fa-save"></i> Guardar</button>
                </div>
            </div>
		</div>
	<br/>
	<br/>
</fieldset>

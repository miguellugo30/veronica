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
                <input value="{{$Dids->tipo}}" type="text" class="form-control" id="tipo" placeholder="Tipo"/>
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
            <div class="form-group">
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
                <input  value="{{$Dids->gateway}}" type="text" class="form-control" id="gateway" placeholder="Gateway"/>
            </div>
            <div class="form-group">
                <label for="fakedid">Fakedid</label>
                <input  value="{{$Dids->fakedid}}" type="text" class="form-control" id="fakedid" placeholder="Fakedid"/>
            </div>
		</div>
		<div class="col-md-12" style="text-align:center">
 	        <button type="submit" class="btn btn-danger deleteDid"><i class="fas fa-trash-alt"></i> Eliminar </button>
			<button type="submit" class="btn btn-warning cancelDid"><i class="fas fa-times"></i> Cancelar</button>
			<button type="submit" class="btn btn-primary updateDid"><i class="fas fa-save"></i> Guardar</button>
		</div>

	<br/>
	<br/>
</fieldset>

<fieldset>
	<legend>
		<i class="fas fa-truck"></i>
		Modificar Did
	</legend>
	<div class="col-md-6" style="float:none; margin:auto">
		<fieldset>
			<legend>
				<i class="fas fa-truck"></i>
				Informacion Did
			</legend>
			
				<div class="form-group">
					<label for="id_empresa">Empresa</label>
					<input value="{{$Dids->id_empresa}}" type="text" class="form-control" id="id_empresa" placeholder="Empresa"/>
                    <input type="hidden" class="form-control" id="id_did" value="{{$Dids->id}}"/>
                    <!-- Esta variable genera un token Laravel se debe colocar en el form -->
					@csrf
				</div>
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
					<label for="id_troncal_sansay">Troncal</label>
					<input  value="{{$Dids->id_troncal_sansay}}" type="text" class="form-control" id="id_troncal_sansay" placeholder="Troncal"/>
				</div>
				<div class="form-group">
					<label for="gateway">Gateway</label>
    	            <input  value="{{$Dids->gateway}}" type="text" class="form-control" id="gateway" placeholder="Gateway"/>
					
				</div>
				<div class="form-group">
					<label for="fakedid">Fakedid</label>
                    <input  value="{{$Dids->fakedid}}" type="text" class="form-control" id="fakedid" placeholder="Fakedid"/>					
				</div>
                
			</fieldset>
		</div>
		
		<div class="col-md-12" style="text-align:center">
 	        <button type="submit" class="btn btn-danger deleteDid"><i class="fas fa-trash-alt"></i> Eliminar </button>
			<button type="submit" class="btn btn-warning cancelDid"><i class="fas fa-times"></i> Cancelar</button>
			<button type="submit" class="btn btn-primary updateDid"><i class="fas fa-save"></i> Guardar</button>
		</div>

	<br/>
	<br/>
</fieldset>

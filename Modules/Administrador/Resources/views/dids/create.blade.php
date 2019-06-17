<fieldset>
	<legend>
		<i class="fas fa-truck"></i>
		Nuevo Did
	</legend>
	<div class="col-md-6" style="float:none; margin:auto">
		<fieldset>
			<legend>
				<i class="fas fa-truck"></i>
				Informacion Did
			</legend>
			
				<div class="form-group">
					<label for="id_empresa">Empresa</label>				
                    <select name="id_empresa" id="id_empresa" class="form-control">
					<option value="">Selecciona una empresa</option>
					@foreach( $empresas as $empresa )
					<option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
					@endforeach
				</select>
                    
                    <!-- Esta variable genera un token Laravel se debe colocar en el form -->
					@csrf
				</div>
				<div class="form-group">
					<label for="tipo">Tipo</label>
					<input type="text" class="form-control" id="tipo" placeholder="Tipo"/>
				</div>                
				<div class="form-group">
					<label for="prefijo">Prefijo</label>
					<input type="text" class="form-control" id="prefijo" placeholder="Prefijo"/>
				</div>
                
				<div class="form-group">
					<label for="did">Did</label>
				  	<input type="text" class="form-control" id="did" placeholder="Did"/>
				</div>
				<div class="form-group">
                    <label for="descripcion">Descripcion</label>
				  	<input type="text" class="form-control" id="descripcion" placeholder="Descripcion"/>
				
				</div>
                
                <div class="form-group">
					<label for="id_troncal_sansay">Troncal</label>
					<input type="text" class="form-control" id="id_troncal_sansay" placeholder="Troncal"/>
				</div>
				<div class="form-group">
					<label for="gateway">Gateway</label>
    	            <input type="text" class="form-control" id="gateway" placeholder="Gateway"/>
					
				</div>
				<div class="form-group">
					<label for="fakedid">Fakedid</label>
                    <input type="text" class="form-control" id="fakedid" placeholder="Fakedid"/>					
				</div>
                
			</fieldset>
		</div>
		
		<div class="col-md-12" style="text-align:center">
			<button type="submit" class="btn btn-warning cancelDid"><i class="fas fa-times"></i> Cancelar</button>
			<button type="submit" class="btn btn-primary saveDid"><i class="fas fa-save"></i> Guardar</button>
		</div>

	<br/>
	<br/>
</fieldset>

<fieldset>
	<legend>
		<i class="fas fa-truck"></i>
		Edici&oacute;n distribuidor
	</legend>
	<div class="col-md-6" style="float:none; margin:auto">
		<fieldset>
			<legend>
				<i class="fas fa-truck"></i>
				Informaci&oacute;n distribuidor
			</legend>
			<form enctype="multipart/form-data" id="editardistribuidores" method="post">
				<div class="form-group">
					<label for="servicio">Servicio</label>
					
					<input type="text" class="form-control" id="servicio" value="{{$distribuidor->servicio}}" placeholder="Servicio">
					<input type="hidden" class="form-control" id="id_distribuidor" value="{{$distribuidor->id}}">
					@csrf
				</div>
				<div class="form-group">
					<label for="distribuidor">Distribuidor</label>
					<input type="text" class="form-control" id="distribuidor" value="{{$distribuidor->distribuidor}}" placeholder="Distribuidor">
				</div>
				<div class="form-group">
					<label for="numero_soporte">Numero Soporte</label>
					<input type="text" class="form-control" id="numero_soporte" value="{{$distribuidor->numero_soporte}}" placeholder="Numero Soporte">
				</div>
				<div class="form-group">
					<label for="prefijo">Prefijo</label>
					<input type="number" min="0" max="5" class="form-control" id="prefijo" value="{{$distribuidor->prefijo}}" placeholder="Prefijo">
				</div>
				<div class="form-group row">
					<label for="image_header" class="col-md-2 col-form-label text-md-right">Imagen<br>
					<img src="/storage/{{$distribuidor->img_header}}" id='image_input_header' width="100px"/></label>
					<input type="file" class="form-control" id='file_input_header' name="file_input_header" 
					placeholder="Imagen header" value="{{$distribuidor->img_header}}"/>
				</div>
				<div class="form-group row">
					<label for="img_pie" class="col-md-2 col-form-label text-md-right">Imagen pie<br>
					<img src="/storage/{{$distribuidor->img_pie}}" id='image_input_pie' width="100px"/></label>
					<input type="file" id="file_input_pie" name="file_input_pie" class="form-control" placeholder="Imagen pie" value="{{$distribuidor->img_pie}}">
				</div>
			</form>
		</fieldset>
	</div>
	
	<div class="col-md-12" style="text-align:center">
		<button type="submit" class="btn btn-danger deleteDistribuidor"><i class="fas fa-trash-alt"></i> Eliminar </button>
		<button type="submit" class="btn btn-warning cancelDistribuidor"><i class="fas fa-times"></i> Cancelar</button>
		<button type="submit" class="btn btn-primary updateDistribuidor"><i class="fas fa-save"></i> Guardar</button>
	</div>
	<br>
	<br>
</fieldset>
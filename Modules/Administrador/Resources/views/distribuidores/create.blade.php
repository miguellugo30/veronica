<fieldset>
	<legend>
		<i class="fas fa-truck"></i>
		Nuevo distribuidor
	</legend>
	<div class="col-md-6" style="float:none; margin:auto">
		<fieldset>
			<legend>
				<i class="fas fa-truck"></i>
				Informacion distribuidor
			</legend>
			<form enctype="multipart/form-data" id="altadistribuidores" method="post">
				<div class="form-group">
					<label for="servicio">Servicio</label>
					<input type="text" class="form-control" id="servicio" placeholder="Servicio">
					@csrf
				</div>
				<div class="form-group">
					<label for="distribuidor">Distribuidor</label>
					<input type="text" class="form-control" id="distribuidor" placeholder="Distribuidor">
				</div>
				<div class="form-group">
					<label for="numero_soporte">Numero Soporte</label>
					<input type="text" class="form-control" id="numero_soporte" placeholder="Numero Soporte">
				</div>
				<div class="form-group">
					<label for="img_header">Imagen header</label>
					<input type="file" class="form-control" id="img_header" name="img_header" placeholder="Imagen header">
				</div>
				<div class="form-group">
					<label for="img_pie">Imagen pie</label>
					<input type="file" class="form-control" id="img_pie" name="img_pie" placeholder="Imagen pie">
				</div>
			</fieldset>
		</div>
		
		<div class="col-md-12" style="text-align:center">
			<button type="submit" class="btn btn-warning cancelDistribuidor"><i class="fas fa-times"></i> Cancelar</button>
			<button type="submit" class="btn btn-primary saveDistribuidor"><i class="fas fa-save"></i> Guardar</button>
		</div>
	</form>
	<br>
	<br>
</fieldset>

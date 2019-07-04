<fieldset>
		<legend>
			<i class="fas fa-truck"></i>
			Nuevo distribuidor
		</legend>
		<div class="col-md-6" style="float:none; margin:auto">
			<fieldset>
				<legend>
					<i class="fas fa-truck"></i>
					Informaci&oacute;n distribuidor
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
						<label for="prefijo">Prefijo</label>
						<input type="number" min="0" maxlength="5" class="form-control" id="prefijo" placeholder="Prefijo" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
					</div>
					<div class="form-group">
						<label for="image_header">Imagen header<br><img src="" id='image_input_header' width="100px"/></label>
						<div class="input-group">
							<input type="file" id='file_input_header' name="file_input_header" class="form-control"/>
							<div class="input-group-append">
								<input type="button" onClick="limpiar()" value="Quitar imagen" class="btn btn-primary btn-sm">
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="img_pie" class="col-md-2 col-form-label text-md-right">Imagen pie<br>
						<img src="" id='image_input_pie' width="100px"/></label>
						<input type="file" id="file_input_pie" name="file_input_pie" class="form-control" placeholder="Imagen pie">
					</div>
				</form>
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

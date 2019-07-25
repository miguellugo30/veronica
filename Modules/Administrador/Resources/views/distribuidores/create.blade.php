<div class="col-md-6" style="float:none; margin:auto">
    <form enctype="multipart/form-data" id="altadistribuidores" method="post">
        <div class="form-group">
            <label for="servicio">Servicio</label>
            <input type="text" class="form-control input-sm" id="servicio" placeholder="Servicio">
            @csrf
        </div>
        <div class="form-group">
            <label for="distribuidor">Distribuidor</label>
            <input type="text" class="form-control input-sm" id="distribuidor" placeholder="Distribuidor">
        </div>
        <div class="form-group">
            <label for="numero_soporte">Numero Soporte</label>
            <input type="text" class="form-control input-sm" id="numero_soporte" placeholder="Numero Soporte">
        </div>
        <div class="form-group">
            <label for="prefijo">Prefijo</label>
            <input type="number" min="0" maxlength="5" class="form-control input-sm" id="prefijo" placeholder="Prefijo" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"/>
        </div>
        <div class="form-group">
            <label for="image_header" class="col-md-3 col-form-label text-md-right">Imagen header<br>
            <img src="" id='image_input_header' width="100px"/></label>
            <input type="file" id='file_input_header' name="file_input_header" class="form-control input-sm"/>
        </div>
        <div class="form-group">
            <label for="img_pie" class="col-md-2 col-form-label text-md-right">Imagen pie<br>
            <img src="" id='image_input_pie' width="100px"/></label>
            <input type="file" id="file_input_pie" name="file_input_pie" class="form-control input-sm" placeholder="Imagen pie">
        </div>
    </form>
</div>
<div class="col-md-6" style="float:none; margin:auto">
    <div class="col-md-6" style="text-align:left">
        <button type="submit" class="btn btn-warning btn-sm cancelDistribuidor"><i class="fas fa-times"></i> Cancelar</button>
    </div>
    <div class="col-md-6" style="text-align:right">
        <button type="submit" class="btn btn-primary btn-sm saveDistribuidor"><i class="fas fa-save"></i> Guardar</button>
    </div>
</div>


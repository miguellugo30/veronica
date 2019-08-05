<form enctype="multipart/form-data" id="editardistribuidores" method="post">
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="servicio">Servicio</label>
                <input type="text" class="form-control form-control-sm" id="servicio" value="{{$distribuidor->servicio}}" placeholder="Servicio">
                <input type="hidden" class="form-control" id="id_distribuidor" value="{{$distribuidor->id}}">
                @csrf
            </div>
            <div class="form-group">
                <label for="distribuidor">Distribuidor</label>
                <input type="text" class="form-control form-control-sm" id="distribuidor" value="{{$distribuidor->distribuidor}}" placeholder="Distribuidor">
            </div>
            <div class="form-group">
                <label for="numero_soporte">Numero Soporte</label>
                <input type="text" class="form-control form-control-sm" id="numero_soporte" value="{{$distribuidor->numero_soporte}}" placeholder="Numero Soporte">
            </div>
            <div class="form-group">
                <label for="prefijo">Prefijo</label>
                <input type="number" min="0" maxlength="5" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control form-control-sm" id="prefijo" value="{{$distribuidor->prefijo}}" placeholder="Prefijo"/>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <div class="text-center">
                    <img src="{{ Storage::url($distribuidor->img_header)}}" id='image_input_header' class="rounded" width="100px"/></label>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input form-control-sm" id="file_input_header" name="file_input_header" lang="es" value="{{$distribuidor->img_header}}">
                    <label class="custom-file-label" for="image_header">Seleccionar Archivo</label>
                </div>
                <!--label for="image_header" class="col-md-2 col-form-label text-md-right">Imagen<br>
                <input type="file" class="form-control form-control-sm" id='file_input_header' name="file_input_header"
                placeholder="Imagen header" value="{{$distribuidor->img_header}}"/-->
            </div>
            <div class="form-group ">
                <div class="text-center">
                    <img src="{{ Storage::url($distribuidor->img_pie)}}" id='image_input_pie' class="rounded" width="100px"/></label>
                </div>
                <div class="custom-file">
                    <input type="file" class="custom-file-input form-control-sm" id="file_input_pie" name="file_input_pie" lang="es" value="{{$distribuidor->img_pie}}">
                    <label class="custom-file-label" for="file_input_pie">Seleccionar Archivo</label>
                </div>
                <!--label for="img_pie" class="col-md-2 col-form-label text-md-right">Imagen pie<br>
                <input type="file" id="file_input_pie" name="file_input_pie" class="form-control form-control-sm" placeholder="Imagen pie" value="{{$distribuidor->img_pie}}"-->
            </div>
        </div>
    </div>
</form>
<!--div class="col-6"  style="float:none; margin:auto">
    <div class="col" >
        <button type="submit" class="btn btn-warning btn-sm  cancelDistribuidor"><i class="fas fa-times"></i> Cancelar</button>
        <button type="submit" class="btn btn-danger btn-sm  deleteDistribuidor"><i class="fas fa-trash-alt"></i> Eliminar </button>
        <button type="submit" class="btn btn-primary btn-sm updateDistribuidor float-right"><i class="fas fa-save"></i> Guardar</button>
    </div>
</div-->

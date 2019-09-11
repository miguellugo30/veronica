<div >
    <form enctype="multipart/form-data" id="formDataSpeech" method="post">
        <div class="col">
            <fieldset>
            <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control form-control-sm" name="nombre" id="nombre"  value="{{$speech->nombre}}">
                    <input type="hidden" name="id" id="id"  value="{{$speech->id}}">
                    @csrf
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input type="text" class="form-control form-control-sm" name="descripcion" id="descripcion"  value="{{$speech->descripcion}}">
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo</label>
                <select name="tipo_{{ $speech->tipo }}" id="tipo" data-action="edit" class="form-control form-control-sm opciones">
                        <option value="" >Selecciona un speech</option>
                        <option value="estatico" {{('estatico' == $speech->tipo) ? 'selected = "selected"':'' }}>Estatico</option>
                        <option value="dinamico" {{('dinamico' == $speech->tipo) ? 'selected = "selected"':'' }}>Dinamico</option>
                    </select>
                </div>
            </fieldset>
        </div>
        <div class="col">

    </form>
</div>

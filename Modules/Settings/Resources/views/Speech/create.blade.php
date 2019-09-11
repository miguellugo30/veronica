<div class="row">
    <form enctype="multipart/form-data" id="altaspeech" method="post">
        <div class="col">
            <fieldset>
                <div class="form-group">
                    <label for="name">Nombre del Speech</label>
                    <input type="text" class="form-control form-control-sm" id="nombre"  value="">
                    @csrf
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <input type="text" class="form-control form-control-sm" id="descripcion"  value="">
                </div>
                <div class="form-group">
                    <label for="tipo"><b>Tipo</b></label>
                        <select name="tipo" id="tipo" class="form-control form-control-sm">
                            <option value="">Seleccione un tipo</option>
                                    <option value="estatico">Estatico</option>
                                    <option value="dinamico">Dinamico</option>
                        </select>
                </div>
            </fieldset>
        </div>
    </form>
</div>

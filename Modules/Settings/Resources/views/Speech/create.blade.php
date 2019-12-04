<div class="row">
    <div class="col-12">
        <form enctype="multipart/form-data" id="altaspeech" method="post">
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="tipo"><b>Tipo</b></label>
                            @csrf
                            <select name="tipo" id="tipo" class="form-control form-control-sm tipo">
                                <option value="">Seleccione un tipo</option>
                                <option value="estatico">Estatico</option>
                                <option value="dinamico">Dinamico</option>
                            </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="nombre"><b>Nombre</b></label>
                        <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Nombre Speech">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="nombre"><b>Descripcion</b></label>
                        <input type="text" class="form-control form-control-sm" id="descripcion" name="descripcion" placeholder="Descripcion Speech">
                    </div>
                </div>
                <div class="col-md-12">
                <fieldset>
                    <legend>Campos de speech</legend>
                        <table id='tipos' class="table table-striped table-sm tableNewSpeech">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <td><input type="button" class="btn btn-primary btn-sm agrega" id="add_s" value = "Agregar" hidden/></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="tr_1" class="clonar">
                                    <td>
                                        <input type="text" class="form-control form-control-sm nombreSpeech" id="nombreSpeech" name="nombreSpeech" placeholder="Nombre" value="">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control form-control-sm descripcion" id="descripcionSpeech" name="descripcionSpeech" placeholder="Descripcion" value="">
                                    </td>
                                    <td class="tr_clone_remove">
                                        <button type="button" name="remove" class="btn btn-danger remove" hidden><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                </fieldset>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <form enctype="multipart/form-data" id="altaspeech" method="post">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="tipo"><b>Tipo</b></label>
                            <select name="tipo" id="tipo" class="form-control form-control-sm tipo">
                                <option value="">Seleccione un tipo</option>
                                <option value="estatico">Estatico</option>
                                <option value="dinamico">Dinamico</option>
                            </select>
                    </div>
                </div>
                <fieldset>
                    <legend>Campos de speech</legend>
                        <table id='tipos' class="table table-striped table-sm tableNewSpeech">
                            <thead>
                                <tr>
                                    <th>Nombre del Speech</th>
                                    <th>Descripcion</th>
                                    <td><input type="button" class="btn btn-primary btn-sm agrega" id="add_s" value = "Agregar" hidden/></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="tr_1" class="clonar">
                                    <td><input type="text" class="form-control form-control-sm" id="nombre" placeholder="Nombre del Speech" value="">
                                        @csrf
                                    </td>
                                    <td><input type="text" class="form-control form-control-sm descripcion" id="descripcion" placeholder="Descripcion" value=""></td>
                                    <td class="tr_clone_remove"><button type="button" name="remove" class="btn btn-danger remove" hidden><i class="fas fa-trash-alt"></i></button></td>
                                </tr>
                            </tbody>
                    {{--<div class="col-4">
                        <fieldset>
                            <div class="form-group">
                                <label for="name"><b>Nombre del Speech</b></label>
                                <input type="text" class="form-control form-control-sm" id="nombre" placeholder="Nombre del Speech" value="">
                                @csrf
                            </div>
                    </div>--}}
                    {{--<div class="col-4">
                            <div class="form-group">
                                <label for="descripcion"><b>Descripción</b></label>
                                <input type="text" class="form-control form-control-sm" id="descripcion" placeholder="Descripcion" value="">
                            </div>
                    </div>--}}
                        </table>
                </fieldset>
            </div>
        </form>
    </div>
</div>

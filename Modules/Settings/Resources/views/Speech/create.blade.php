<div class="row">
    <div class="col-12">
        <form enctype="multipart/form-data" id="altaspeech" method="post">
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="tipo"><b>Tipo *:</b></label>
                            <select name="tipo" id="tipo" class="form-control form-control-sm tipo">
                                <option value="">Seleccione un tipo</option>
                                <option value="estatico">Estático</option>
                                <option value="dinamico">Dinámico</option>
                            </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="nombre"><b>Nombre *:</b></label>
                        <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Nombre">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="nombre"><b>Descripción *:</b></label>
                        <input type="text" class="form-control form-control-sm" id="descripcion" name="descripcion" placeholder="Descripción">
                    </div>
                </div>
                <div class="col-md-12">
                <fieldset>
                    <div id='tipo_dinamico' style="display:none">
                        <table  class="table table-striped table-sm tableNewSpeech" >
                            <thead>
                                <tr>
                                    <th>Speech Inicial *:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="tr_1" class="clonar">
                                    <td>
                                        <select name="speech-inicial" id="speech-inicial" class="form-control form-control-sm" >
                                            <option value="">Selecciona una opción</option>
                                            @foreach ($speechs as $speech)
                                                @if ($speech->tipo == 'estatico')
                                                    <option value="{{$speech->id}}">{{$speech->nombre}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <legend>Opciones Speech</legend>
                        <table class="table table-striped table-sm tableNewSpeechDinamico">
                            <thead>
                                <tr>
                                    <th>Opción *:</th>
                                    <th>Speech *:</th>
                                    <td><input type="button" class="btn btn-primary btn-sm agrega" id="add_s" value = "Agregar" hidden/></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="tr_1" class="clonar">
                                    <td>
                                        <input type="text" class="form-control form-control-sm" id="opcion_speech" name="opcion_speech" placeholder="Opción" value="">
                                    </td>
                                    <td>
                                        <select name="speech_id" id="speech_id" class="form-control form-control-sm">
                                            <option value="">Selecciona una opción</option>
                                            @foreach ($speechs as $speech)
                                                <option value="{{$speech->id}}">{{$speech->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" name="remove" class="btn btn-danger remove tr_clone_remove" style="display:none"><i class="fas fa-trash-alt"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                        <table id='tipo_estatico' class="table table-striped table-sm" style="display:none">
                            <thead>
                                <tr>
                                    <th>Texto *:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                     <td>
                                        <textarea class="form-control form-control-sm descripcion" id="descripcionSpeechEs" name="descripcionSpeech" id="descripcionSpeech" cols="122" rows="10"></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                </fieldset>
                </div>
            </div>
            <div class="form-group">
                <small class="form-text text-muted"> <b>*Campos obligatorios.</b></small>
            </div>
            <div class="alert alert-danger print-error-msg" role="alert" style="display:none">
                <ul></ul>
            </div>
        </form>
    </div>
</div>

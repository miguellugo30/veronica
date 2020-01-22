<div class="row">
    <div class="col-12">
        <form enctype="multipart/form-data" id="editspeech" method="post">
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="tipo"><b>Tipo *:</b></label>
                            <select name="tipo{{-- $speech->tipo --}}" id="tipo" data-action="edit" class="form-control form-control-sm tipo" disabled>
                                <option value="">Seleccione un tipo</option>
                                <option value="estatico" {{('estatico' == $speech->tipo) ? 'selected = "selected"':'' }}>Estatico</option>
                                <option value="dinamico" {{('dinamico' == $speech->tipo) ? 'selected = "selected"':'' }}>Dinamico</option>
                            </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="nombre"><b>Nombre *:</b></label>
                        <input type="text" class="form-control form-control-sm nombre" id="nombre" name="nombre" value="{{ $speech->nombre }}" disabled>
                        <input type="hidden" name="id" id="id"  value="{{ $speech->id }}">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="nombre"><b>Descripcion *:</b></label>
                            <input type="text" class="form-control form-control-sm descripcion" id="descripcion" name="descripcion" value="{{ $speech->descripcion }}" disabled>
                    </div>
                </div>
                <div class="col-md-12">
                    <fieldset>

                        @if ( $speech->tipo == 'dinamico' )
                            <div id='tipo_dinamico'>
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
                                                    @foreach ($speechs as $sp)
                                                        @if ($sp->tipo == 'estatico')
                                                            <option value="{{$sp->id}}" {{ $campos->where('tipo', 1)->first()->speech_id_hijo == $sp->id ? 'selected=selected' : '' }}>{{$sp->nombre}}</option>
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
                                            <td><input type="button" class="btn btn-primary btn-sm agrega" id="add_s" value = "Agregar"/></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                        @foreach ($campos as $cp)
                                            @if ( $cp->tipo == 0 )
                                                <tr id="tr_{{$i}}" class="clonar">
                                                    <td>
                                                        <input type="text" class="form-control form-control-sm" id="opcion_speech_{{$i}}" name="opcion_speech_{{$i}}" placeholder="Opción" value="{{ $cp->nombre }}">
                                                    </td>
                                                    <td>
                                                        <select name="speech_id_{{$i}}" id="speech_id_{{$i}}" class="form-control form-control-sm">
                                                            <option value="">Selecciona una opción</option>
                                                            @foreach ($speechs as $sp)
                                                                <option value="{{$sp->id}}" {{ $cp->speech_id_hijo == $sp->id ? 'selected=selected' : '' }}>{{$sp->nombre}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" name="remove" class="btn btn-danger remove tr_clone_remove_edit" data-id="{{$cp->id}}"><i class="fas fa-trash-alt"></i></button>
                                                    </td>
                                                </tr>
                                                @php
                                                    {{ $i++; }}
                                                @endphp
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <table id='tipo_estatico' class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Texto *:</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <textarea class="form-control form-control-sm descripcion" id="descripcionSpeechEs" name="descripcionSpeech" id="descripcionSpeech" cols="122" rows="10">{{$speech->texto}}</textarea>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif
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

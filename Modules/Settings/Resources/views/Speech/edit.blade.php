<div class="row">
        <div class="col-12">
            <form enctype="multipart/form-data" id="editspeech" method="post">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="tipo"><b>Tipo</b></label>
                                <select name="tipo{{-- $speech->tipo --}}" id="tipo" data-action="edit" class="form-control form-control-sm tipo" disabled>
                                    <option value="">Seleccione un tipo</option>
                                    <option value="estatico" {{('estatico' == $speech->tipo) ? 'selected = "selected"':'' }}>Estatico</option>
                                    <option value="dinamico" {{('dinamico' == $speech->tipo) ? 'selected = "selected"':'' }}>Dinamico</option>
                                </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="nombre"><b>Nombre</b></label>
                                <input type="text" class="form-control form-control-sm nombre" id="nombre" name="nombre" value="{{ $speech->nombre }}" disabled>
                                <input type="hidden" name="id" id="id"  value="{{ $speech->id }}">
                                @csrf
                        </div>
                    </div>
                    <fieldset>
                        <legend>Campos de speech</legend>
                            <table id='tipos' class="table table-striped table-sm tableEditSpeech">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <td><input type="button" class="btn btn-primary btn-sm agrega" id="add_os" value = "Agregar" {{('dinamico' == $speech->tipo) ? '':'hidden' }}/></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($speech->Opciones_Speech as $opcion)
                                    <tr id="tr_{{ $opcion->id }}" class="clonar">
                                        <td><input type="text" class="form-control form-control-sm nombreSpeech" id="nombreSpeech" name="nombreSpeech_{{ $opcion->id }}" value="{{ $opcion->nombre }}"></td>
                                        <td><input type="text" class="form-control form-control-sm descripcion" id="descripcion" name="descripcion_{{ $opcion->id }}" value="{{ $opcion->texto }}"></td>
                                        <td class="tr_clone_remove"><button type="button" name="remove" class="btn btn-danger remove" {{('dinamico' == $speech->tipo) ? '':'hidden' }}><i class="fas fa-trash-alt"></i></button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </fieldset>
                </div>
            </form>
        </div>
    </div>


{{--<div class="col-12">
    <form enctype="multipart/form-data" id="formDataSpeech" method="post">
        <div class="col-6">
            <fieldset>
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                            <select name="tipo_{{ $speech->tipo }}" id="tipo" data-action="edit" class="form-control form-control-sm opciones">
                                <option value="" >Selecciona un speech</option>
                                <option value="estatico" {{('estatico' == $speech->tipo) ? 'selected = "selected"':'' }}>Estatico</option>
                                <option value="dinamico" {{('dinamico' == $speech->tipo) ? 'selected = "selected"':'' }}>Dinamico</option>
                            </select>
                    </div>
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
</div>--}}

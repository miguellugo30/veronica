<fieldset>
    <legend>
        <i class="far fa-building"></i>
        <b>Empresa: {{$nombreEmpresa}}</b>
    </legend>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="form-group">
            <input type="hidden" name="id_empresa" id="id_empresa" value="{{ $idEmpresa }}">
            <input type="hidden" name="action" id="action" value="dataModulo">
            @csrf
            <div class="col-md-6">
                @foreach ($modulos as $modulo)
                    @if ($loop->iteration == 10)
                        </div>
                        <div class="col-md-6">
                    @endif
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="modulos[]" class="modulosEmpresa" id="modulo" value="{{ $modulo->id }}">
                            {{ $modulo->nombre }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-6" style="float:none; margin:auto">
            <div class="col-md-6" style="text-align:left">
                <button type="submit" class="btn btn-warning cancelEmpresa"><i class="fas fa-times"></i> Cancelar</button>
            </div>
            <div class="col-md-6" style="text-align:right">
                <button type="submit" class="btn btn-primary saveEmpresaModulos">Siguiente <i class="fas fa-arrow-alt-circle-right"></i></button>
            </div>
        </div>
    </div>
    <br>
    <br>
</fieldset>

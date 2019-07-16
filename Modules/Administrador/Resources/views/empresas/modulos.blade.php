<fieldset>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="form-group">
            <input type="hidden" name="action" id="action" value="dataModulo">
            <input type="hidden" name="id_empresa" id="id_empresa" value="{{ $idEmpresa }}">
            @csrf
            <div class="col-md-6">
                @if (isset($modulosEmpresa))
                    @foreach ($modulos as $modulo)
                        @if ($loop->iteration == 10)
                            </div>
                            <div class="col-md-6">
                        @endif
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="modulos[]" class="modulosEmpresa" id="modulo" value="{{ $modulo->id }}" {{  in_array( $modulo->id, $modulosEmpresa ) ? 'checked="checked"' : '' }}>
                                {{ $modulo->nombre }}
                            </label>
                        </div>
                    @endforeach
                @else
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
                @endif
            </div>
        </div>
    </div>
</fieldset>

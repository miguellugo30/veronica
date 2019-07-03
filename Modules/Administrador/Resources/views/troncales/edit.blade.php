<fieldset>
    <legend>
        <i class="fas fa-project-diagram"></i>
        Editar Troncal
    </legend>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombre" value="{{ $troncal->nombre }}">
                <input type="hidden" name="id" id="id" value="{{ $id }}">
                <input type="hidden" name="id_empresa_ant" id="id_empresa_ant" value="">
                @csrf
            </div>
            <div class="form-group">
                <label for="troncal_sansay">Troncal Sansay</label>
                <input type="text" class="form-control" id="troncal_sansay" placeholder="Troncal Sansay" value="{{ $troncal->troncal_sansay }}">
            </div>
        </div>
        <div  class="col-md-6">
            <fieldset>

                <legend>Empresas</legend>
                <div class="form-group">
                    <select name="id_empresa" id="id_empresa" class="form-control" multiple>
                        @foreach( $empresas as $empresa )
                            <option value="{{ $empresa->id }}" {{ in_array( $empresa->id, $selectEmpresa ) ? 'selected="selected"' : '' }}>{{ $empresa->nombre }}</option>
                        @endforeach
                    </select>
                    <p class="help-block">Ctrl + click, para seleccionar mas de una empresa.</p>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="col-md-12">
        <div class="col-md-6" style="float:none; margin:auto">
            <div class="col-md-6" style="text-align:left">
                <button type="submit" class="btn btn-warning cancelTroncal"><i class="fas fa-times"></i> Cancelar</button>
                <button type="submit" class="btn btn-danger deleteTroncal"><i class="fas fa-trash-alt"></i> Eliminar</button>
            </div>
            <div class="col-md-6" style="text-align:right">
                <button type="submit" class="btn btn-primary updateTrocal"><i class="fas fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
    <br>
    <br>
</fieldset>

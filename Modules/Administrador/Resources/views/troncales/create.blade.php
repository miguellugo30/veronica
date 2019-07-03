<fieldset>
    <legend>
        <i class="fas fa-project-diagram"></i>
        Nueva Troncal
    </legend>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                @csrf
            </div>
            <div class="form-group">
                <label for="troncal_sansay">Troncal Sansay</label>
                <input type="text" class="form-control" id="troncal_sansay" placeholder="Troncal Sansay">
            </div>
        </div>
        <div class="col-md-6">
            <fieldset>
                <legend>Empresas</legend>
            </fieldset>
            <div class="form-group">
                <select name="id_empresa" id="id_empresa" class="form-control" multiple>
                    @foreach( $empresas as $empresa )
                        <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                    @endforeach
                </select>
                <p class="help-block">Ctrl + click, para seleccionar mas de una empresa.</p>
            </div>
        </div>
    </div>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="col-md-6" style="text-align:left">
            <button type="submit" class="btn btn-warning cancelTroncal"><i class="fas fa-times"></i> Cancelar</button>
        </div>
        <div class="col-md-6" style="text-align:right">
            <button type="submit" class="btn btn-primary saveTroncal"><i class="fas fa-save"></i> Guardar</button>
        </div>
    </div>
    <br>
    <br>
</fieldset>

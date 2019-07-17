<fieldset>
	<legend>
        <i class="fas fa-phone"></i>
		Nuevo Did
	</legend>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="form-group">
            <label for="id_empresa">Empresa</label>
            <select name="id_empresa" id="id_empresa" class="form-control">
                <option value="">Selecciona una empresa</option>
                @foreach( $empresas as $empresa )
                <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                @endforeach
            </select>
            <!-- Esta variable genera un token Laravel se debe colocar en el form -->
            @csrf
        </div>

        <div class="form-group">
            <div class="resultEmpresa">
            </div>
        </div>
        <div class="col-md-12">
            <br>
            <div class="col-md-6" style="float:none; margin:auto">
                <div class="col-md-6" style="text-align:left">
                    <button type="submit" class="btn btn-warning cancelDid"><i class="fas fa-times"></i> Cancelar</button>
                </div>
                <div class="col-md-6" style="text-align:right">
                    <button type="submit" class="btn btn-primary saveDid"><i class="fas fa-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
	<br/>
	<br/>
</fieldset>

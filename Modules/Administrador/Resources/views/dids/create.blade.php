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
        </div>
        <div class="form-group">
            <!-- Esta variable genera un token Laravel se debe colocar en el form -->
            @csrf
            <label for="prefijo">Prefijo</label>
            <input type="number" class="form-control" id="prefijo" placeholder="Prefijo" min="0" value="20"/>
        </div>
        <div class="form-group">
            <label for="did">Did</label>
            <div class="row">
                <div class="col-xs-3">
                    <input type="number" class="form-control" id="did" min="0" placeholder="Rango did inicio"/>
                </div>
                <div class="col-xs-1">
                    <i class="fas fa-minus"></i>
                </div>
                <div class="col-xs-3">
                    <input type="number" class="form-control" id="did" min="0" placeholder="Rango did fin"/>
                </div>
                <div class="col-xs-3">
                    <button type="button" class="btn btn-sm btn-success glyphicon glyphicon-plus">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="did">Canal</label>
            <select name="id_canal" id="id_canal" class="form-control">
                <option value="">Selecciona un canal</option>
                @foreach( $canales as $canal )
                    <option value="{{ $canal->id }}">{{ $canal->canal }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="referencia">Referencia</label>
            <input type="text" class="form-control" id="referencia" placeholder="Referencia"/>
        </div>
        <div class="form-group">
            <label for="referencia">Numero Real</label>
            <input type="text" class="form-control" id="numero_real" placeholder="Numero Real"/>
        </div>
        <div class="form-group">
            <label for="gateway">Gateway</label>
            <br>
            <br>
            <label class="radio-inline">
                <input type="radio" name="gateway" id="gateway" value=""> Habilitado
            </label>
            <label class="radio-inline">
                <input type="radio" name="gateway" id="gateway" value="0" checked> Deshabilitado
            </label>
        </div>
        <div class="form-group">
            <label for="fakedid">Fakedid</label>
            <br>
            <br>
            <label class="radio-inline">
                <input type="radio" name="fakedid" id="fakedid" value="1" > Habilitado
            </label>
            <label class="radio-inline">
                <input type="radio" name="fakedid" id="fakedid" value="0" checked> Deshabilitado
            </label>
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
	<br/>
	<br/>
</fieldset>

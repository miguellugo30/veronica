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
<<<<<<< HEAD
            <label for="tipo">Tipo</label>
            <select name="tipo" id="tipo" class="form-control">
                <option value="">Selecciona un tipo</option>
                <option value="1" selected>Did</option>
                <option value="2">Análogo</option>
            </select>
        </div>
        <div class="form-group">
            <label for="prefijo">Prefijo</label>
            <input type="text" class="form-control" id="prefijo" placeholder="Prefijo"/>
        </div>
        <div class="form-group">
            <label for="did">Did</label>
            <input type="text" class="form-control" id="did" placeholder="Did"/>
=======
>>>>>>> 81fcec682f8e6ded6aa1dbb00ba9269c93e90ef9
        </div>
        
        <div class="form-group">
<<<<<<< HEAD
            <label for="descripcion">Descripción</label>
            <input type="text" class="form-control" id="descripcion" placeholder="Descripcion"/>
        </div>
        <div class="form-group showTroncales">

        </div>
        <div class="form-group">
            <label for="gateway">Gateway</label>
            <br>
            <br>
            <label class="radio-inline">
                <input type="radio" name="gateway" id="gateway" value="1"> Habilitado
            </label>
            <label class="radio-inline">
                <input type="radio" name="gateway" id="gateway" value="0" checked> Deshabilitado
            </label>
=======
            <div class="resultEmpresa">
            </div>
>>>>>>> 81fcec682f8e6ded6aa1dbb00ba9269c93e90ef9
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

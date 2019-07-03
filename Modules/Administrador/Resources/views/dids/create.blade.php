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
            <label for="tipo">Tipo</label>
            <input type="text" class="form-control" id="tipo" placeholder="Tipo"/>
        </div>
        <div class="form-group">
            <label for="prefijo">Prefijo</label>
            <input type="text" class="form-control" id="prefijo" placeholder="Prefijo"/>
        </div>
        <div class="form-group">
            <label for="did">Did</label>
            <input type="text" class="form-control" id="did" placeholder="Did"/>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripcion</label>
            <input type="text" class="form-control" id="descripcion" placeholder="Descripcion"/>
        </div>
        <div class="form-group showTroncales">
            <!--label for="Troncales_id">Troncal</label>
            <select name="Troncales_id" id="Troncales_id" class="form-control">
                <option value="">Selecciona una troncal</option>
                {{--@foreach( $troncales as $troncal )
                    <option value="{{ $troncal->id }}">{{ $troncal->nombre }}</option>
                @endforeach--}}
            </select-->
        </div>
        <div class="form-group">
            <label for="gateway">Gateway</label>
            <input type="text" class="form-control" id="gateway" placeholder="Gateway"/>
        </div>
        <div class="form-group">
            <label for="fakedid">Fakedid</label>
            <input type="text" class="form-control" id="fakedid" placeholder="Fakedid"/>
        </div>
    </div>
    <div class="col-md-12">
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

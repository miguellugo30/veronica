<fieldset>
    <legend>
        <i class="fas fa-project-diagram"></i>
        Editar Canal
    </legend>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="form-group">
            <label for="distribuidores">Distribuidor</label>
            <select name="distribuidores_canal" id="distribuidores_canal" class="form-control" autofocus>
                <option value="" >Selecciona un distribuidor</option>
                @foreach( $distribuidores as $distribuidor )
                    <option value="{{ $distribuidor->id }}" data-prefijo="{{ $distribuidor->prefijo }}" {{ ( $canal->Cat_Distribuidor_id == $distribuidor->id )  ? 'selected' : '' }}>{{ $distribuidor->servicio }}</option>
                @endforeach
            </select>
        </div>
        @csrf
        <input type="hidden" name="id" id="id" value="{{ $canal->id }}">
        <div class="form-group">
            <div class="resultDistribuidor">  
                <label for="Troncales_id_canal">Troncal</label>
                <select name="Troncales_id_canal" id="Troncales_id_canal" class="form-control" autofocus>
                    <option value="">Selecciona una troncal</option>
                    @foreach( $troncales as $troncal )
                        <option value="{{ $troncal->id }}"  {{ ( $canal->Troncales_id == $troncal->id )  ? 'selected="selected"' : '' }}>{{ $troncal->nombre }}</option>
                    @endforeach
                </select>
                <br>
                <label for="Empresas_id_canal">Empresas</label>
                <select name="Empresas_id_canal" id="Empresas_id_canal" class="form-control" autofocus>
                    <option value="">Selecciona una empresa</option>
                    @foreach( $empresas as $empresa )
                        <option value="{{ $empresa->id }}" {{ ( $canal->Empresas_id == $empresa->id )  ? 'selected="selected"' : '' }}>{{ $empresa->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-12" style="padding:10px;">
        <div class="col-md-6" style="float:none; margin:auto">
            <div class="col-md-6" style="text-align:left">
                <button type="submit" class="btn btn-warning cancelCanal"><i class="fas fa-times"></i> Cancelar</button>
            </div>
            <div class="col-md-6" style="text-align:right">
                <button type="submit" class="btn btn-primary updateCanal"><i class="fas fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
    <br>
    <br>
</fieldset>

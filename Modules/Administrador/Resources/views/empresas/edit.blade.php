<fieldset>
        <legend>
            <i class="fas fa-project-diagram"></i>
            Nueva Troncal
        </legend>
        <div class="col-md-6" style="float:none; margin:auto">
            <div class="form-group">
                <label for="distribuidores">Distribuidor</label>
                <select name="distribuidores" id="distribuidores" class="form-control">
                    <option value="" >Selecciona un distribuidor</option>
                    @foreach( $distribuidores as $distribuidor )
                        <option value="{{ $distribuidor->id }}"  {{ $distribuidor->id ==  $troncal->Cat_Distribuidor->id ? 'selected="selected"' : '' }}>{{ $distribuidor->servicio }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" placeholder="Nombre" value="{{ $troncal->nombre }}">
                <input type="hidden" name="id" id="id" value="{{ $troncal->id }}">
                @csrf
            </div>
            <div class="form-group">
                <label for="ip_media">IP Media</label>
                <input type="text" class="form-control" id="ip_media" placeholder="IP Media" value="{{ $troncal->ip_media }}">
            </div>
            <div class="form-group">
                <label for="ip_host">IP Host</label>
                <input type="text" class="form-control" id="ip_host" placeholder="IP Host" value="{{ $troncal->ip_host }}">
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

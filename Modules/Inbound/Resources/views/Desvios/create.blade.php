        <div class="col">
            <fieldset>
                <div class="form-group">
                    <label for="nombre">Nombre Del Desvio</label>
                    <input type="text" class="form-control form-control-sm" id="nombre"  value="">
                    <input type="hidden" class="form-control form-control-sm" id="Empresas_id"  value="{{$empresa_id}}">

                    @csrf
                </div>
                <div class="form-group">
                    <label for="Canales_id">Canal</label>
                        <select name="Canales_id" id="Canales_id" class="form-control form-control-sm">
                            <option value="">Selecciona una opción</option>
                            @foreach ($canales as $canal)
                                <option value="{{$canal->id}}">{{$canal->Cat_Tipo_Canales->nombre}}</option>

                            @endforeach
                        </select>
                </div>
                <div class="form-group">
                    <label for="dial">Destino</label>
                    <input type="text" class="form-control form-control-sm" id="dial"  value="">
                </div>
                <div class="form-group">
                    <label for="ringeo">Tiempo De Ringeo</label>
                    <input type="text" class="form-control form-control-sm" id="ringeo"  value="" placeholder="Mayor a 10 segundos">
                </div>
            </fieldset>
        </div>

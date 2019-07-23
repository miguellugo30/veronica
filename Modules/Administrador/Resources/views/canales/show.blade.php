<label for="Troncales_id_canal">Troncal</label>
<select name="Troncales_id_canal" id="Troncales_id_canal" class="form-control" autofocus>
    <option value="">Selecciona una troncal</option>
    @foreach( $troncales as $troncal )
        <option value="{{ $troncal->id }}">{{($troncal->nombre == "") ? "AMD" : $troncal->nombre }}</option>
    @endforeach
</select>
<label for="Empresas_id_canal">Empresas</label>
<select name="Empresas_id_canal" id="Empresas_id_canal" class="form-control" autofocus>
    <option value="">Selecciona una empresa</option>
    @foreach( $empresas as $empresa )
        <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
    @endforeach
</select>
<br>
<div class="form-group">
    <label for="Canal">Canales</label>
    <h5> Mantener seleccionados solo los canales que se desean crear:</h5> 
</div>
<div>
@foreach ($canales as $canal)
    <div class="col-md-12 canal" style="text-align:center;border:grey 1px solid;">
        <label for="{{$canal->nombre}}" style="background-color:darkgray;text-align:left;">{{$canal->nombre}}</label>
        <br>
        <div class="col-md-1">
            <input type="checkbox" id="checkcanal" name="checkcanal" value="{{$canal->id}}" checked>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control canal_troncal" id="canal_troncal{{$canal->id}}" placeholder="{ TRONCAL }" readonly>
        </div>
        <div class="col-md-1" style="width: 0%;padding: 0px;font-size: 20px;">
            <label for="">/</label>
        </div>       
        <div class="col-md-2">
            <input type="text" class="form-control canal_prefijo" name="canal_prefijo{{$canal->id}}" id="canal_prefijo{{$canal->id}}" placeholder="{ PREFIJO }" readonly>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control canal_empresa" name="canal_empresa{{$canal->id}}" id="canal_empresa{{$canal->id}}" placeholder="{ ID_EMPRESA }" readonly>
        </div>
        <div class="col-md-2">
            <input type="number" class="form-control" name="canal_tipo{{$canal->id}}" id="canal_tipo{{$canal->id}}" value="{{$canal->prefijo}}" placeholder="{ TIPO }">
        </div>
        <br><br>
    </div>
@endforeach
</div>

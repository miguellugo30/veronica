<br>
<br>
@if ( Session::has( 'infraestructura' ) )
    @php
        $datainfraestructura = Session::get( 'infraestructura' );
    @endphp
@endif
<div class="col-6" style="float:none; margin:auto">
    <div class="form-group">
        <label for="dominio"><b>Dominio *:</b></label>
        <div class="input-group mb-2">
            <input type="text" class="form-control form-control-sm" id="dominio" name="dominio" placeholder="dominio" value="{{ isset( $datainfraestructura ) ? $datainfraestructura['dominio'] : 'veronica.com' }}">
            <div class="input-group-prepend">
                <div class="input-group-text "></div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="base_datos_empresa"><b>Base de datos *:</b></label>
        <select name="base_datos_empresa" id="base_datos_empresa" class="form-control form-control-sm">
            <option value="" >Selecciona una Base de datos</option>
            @foreach( $data['baseDatos'] as $baseDato )
                <option value="{{ $baseDato->id }}" {{ isset( $datainfraestructura ) ? $datainfraestructura['base_datos_empresa'] ==  $baseDato->id ? 'selected' : '' : '' }} >{{ $baseDato->ip }} || {{ $baseDato->nombre }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="media_server_empresas"><b>Media Server *:</b></label>
        <select name="media_server_empresas" id="media_server_empresas" class="form-control form-control-sm">
            <option value="" >Selecciona un Media Server</option>
            @foreach( $data['medias'] as $media )
                <option value="{{ $media->id }}" {{ isset( $datainfraestructura ) ? $datainfraestructura['media_server_empresas'] ==  $media->id ? 'selected' : '' : '' }} >{{ $media->ip_pbx }} || {{ $media->media_server }}</option>
            @endforeach
        </select>
    </div>
</div>

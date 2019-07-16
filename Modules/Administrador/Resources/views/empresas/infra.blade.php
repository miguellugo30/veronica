<fieldset>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="form-group ">
            <label for="dominio">Dominio</label>
            <div class="input-group">
                <input type="text" class="form-control input-sm" id="dominio" name="dominio" placeholder="dominio" aria-describedby="basic-addon2" value="{{ str_replace(' ', '_', $empresa->nombre ) }}">
                <span class="input-group-addon" id="basic-addon2">{{ $Cat_Distribuidor_id == 11 ? '.nimbuscca.mx' : '.nimbuscc.mx' }}</span>
                <input type="hidden" name="id_empresa" id="id_empresa" value="{{ $empresa->id }}">
                <input type="hidden" name="Cat_Distribuidor_id" id="Cat_Distribuidor_id" value="{{ $Cat_Distribuidor_id }}">
                <input type="hidden" name="action" id="action" value="dataInfra">
                @csrf
            </div>
        </div>
        <div class="form-group">
            <label for="base_datos_empresa">Base de datos</label>
            <select name="base_datos_empresa" id="base_datos_empresa" class="form-control input-sm">
                <option value="" >Selecciona una Base de datos</option>
                @if ( $empresa->Config_Empresas != null )
                    @foreach( $baseDatos as $baseDato )
                        <option value="{{ $baseDato->id }}" {{ $empresa->Config_Empresas->Cat_Base_Datos_id == $baseDato->id ? 'selected="selected"' : ''  }}>{{ $baseDato->ip }} || {{ $baseDato->nombre }}</option>
                    @endforeach
                @else
                    @foreach( $baseDatos as $baseDato )
                        <option value="{{ $baseDato->id }}" >{{ $baseDato->ip }} || {{ $baseDato->nombre }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="form-group">
            <label for="media_server_empresas">Media Server</label>
            <select name="media_server_empresas" id="media_server_empresas" class="form-control input-sm">
                <option value="" >Selecciona un Media Server</option>
                @if ( $empresa->Config_Empresas != null )
                    @foreach( $medias as $media )
                        <option value="{{ $media->id }}" {{ $empresa->Config_Empresas->Cat_IP_PBX_id == $media->id ? 'selected="selected"' : ''  }}>{{ $media->ip_pbx }} || {{ $media->media_server }}</option>
                    @endforeach
                @else
                    @foreach( $medias as $media )
                        <option value="{{ $media->id }}" >{{ $media->ip_pbx }} || {{ $media->media_server }}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <br>
    <br>
</fieldset>

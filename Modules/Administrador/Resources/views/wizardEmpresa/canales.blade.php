<br>
<br>
@if ( Session::has( 'canales' ) )
    @php
        $dataCanales = array_chunk( Session::get( 'canales' ), 5 );
    @endphp
@endif
{{-- {{ dd( $dataCanales ) }}
 --}}<div class="col-md-12">
    <table  class="table table-striped table-sm tableNewCanal">
        <thead>
            <tr>
                <th>Tipo</th>
                <th>Protocolo</th>
                <th>Troncal</th>
                <th>Prefijo</th>
                <td class="text-center">
                    <button type="button" class="btn btn-success btn-sm" id="addCanalWizard"><i class="far fa-plus-square"></i></button>
                </td>
            </tr>
        </thead>
        <tbody>
            @if ( ! isset( $dataCanales ) )
                <tr id="tr_1">
                    <td>
                        <select name="tipo_canal_1" id="tipo_canal_1" class="form-control  form-control-sm tipo_canal" data-pos="1">
                            <option value="">Selecciona un tipo de canal</option>
                            @foreach( $data['canales'] as $canal )
                            <option value="{{ $canal->id }}" data-pre_tipo="{{ $canal->prefijo }}">{{ $canal->nombre }}</option>
                            @endforeach
                        </select>
                    <td>
                        <input type="text" class="form-control form-control-sm protocolo" name="protocolo_1" id="protocolo_1" value="" readonly>
                    </td>
                    <td>
                        <select name="Troncales_id_canal_1" id="Troncales_id_canal_1" class="form-control Troncales_id_canal  form-control-sm" >
                            <option value="">Selecciona una troncal</option>
                            @foreach( $data['troncales'] as $troncal )
                                <option value="{{ $troncal->id }}">{{($troncal->nombre == "") ? "AMD" : $troncal->nombre }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm prefijo" name="prefijo_1" id="prefijo_1" value="" readonly>
                        <input type="hidden" class="form-control form-control-sm nombre_troncal" name="nombre_troncal_1" id="nombre_troncal_1" value="">
                    </td>
                    <td class="deleteCanalWizard text-center">
                        <button type="button" name="remove" class="btn btn-danger btn-sm text-center" style="display:none"><i class="far fa-trash-alt"></i></button>
                    </td>
                </tr>
            @else
                @for ($i = 0; $i < count( $dataCanales ); $i++)
                    <tr id="tr_{{ $i + 1 }}">
                        <td>
                            <select name="tipo_canal_{{ $i + 1 }}" id="tipo_canal" class="form-control  form-control-sm tipo_canal" data-pos="{{ $i + 1 }}">
                                <option value="">Selecciona un tipo de canal</option>
                                @foreach( $data['canales'] as $canal )
                                    <option value="{{ $canal->id }}" {{ $canal->id == $dataCanales[$i][0] ? 'selected' : ''  }}  data-pre_tipo="{{ $canal->prefijo }}">{{ $canal->nombre }}</option>
                                @endforeach
                            </select>
                        <td>
                            <input type="text" class="form-control form-control-sm protocolo" name="protocolo_{{ $i + 1 }}" id="protocolo_{{ $i + 1 }}" value="{{ $dataCanales[$i][1] }}" readonly>
                        </td>
                        <td>
                            <select name="Troncales_id_canal_{{ $i + 1 }}" id="Troncales_id_canal_{{ $i + 1 }}" class="form-control Troncales_id_canal  form-control-sm" >
                                <option value="">Selecciona una troncal</option>
                                @foreach( $data['troncales'] as $troncal )
                                    <option value="{{ $troncal->id }}" {{ $troncal->id == $dataCanales[$i][2] ? 'selected' : ''  }} >{{($troncal->nombre == "") ? "AMD" : $troncal->nombre }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="text" class="form-control form-control-sm prefijo" name="prefijo_{{ $i + 1 }}" id="prefijo_{{ $i + 1 }}" value="{{ $dataCanales[$i][3] }}">
                            <input type="hidden" class="form-control form-control-sm nombre_troncal" name="nombre_troncal_{{ $i + 1 }}" id="nombre_troncal_{{ $i + 1 }}" value="{{ $dataCanales[$i][4] }}">
                        </td>
                        <td class="deleteCanalWizard">
                            @if ( $i > 0 )
                                <button type="button" name="remove" class="btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></button>
                            @endif
                        </td>
                    </tr>
                @endfor
            @endif
        </tbody>
    </table>
    <div class="callout callout-info">
        <h6><b>Nota</b></h6>

        <p>Al finalizar el proceso alta, se completara el prefijo <b>( ID Empresa + Prefijo )</b></p>
      </div>
</div>

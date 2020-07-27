<br><br>
@if ( Session::has( 'modulo' ) )
    @php
        $datamodulo = Session::get( 'modulo' );
    @endphp
@endif
@if ( Session::has( 'posiciones' ) )
    @php
        $dataposiciones = Session::get( 'posiciones' );
    @endphp
@endif

<div class="row">
    <div class="col">
        <div class="form-group row">
            <label class="col-sm-5 col-form-label" for="agentes_entrada"><b>Agentes de entrada :</b></label>
            <div class="col-sm-7">
                <input type="number" min="1" max="200" class="form-control form-control-sm" id="agentes_entrada" name="agentes_entrada" value="{{ isset( $dataposiciones ) ? $dataposiciones['agentes_entrada'] : '5' }}" placeholder="Agentes entrada"  {{ array_key_exists( 'inbound', $datamodulo ) ? '' : 'readonly' }}>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="form-group row">
            <label class="col-sm-5 col-form-label" for="agentes_salida"><b>Agentes de salida :</b></label>
            <div class="col-sm-7">
                <input type="number" min="1" max="200" class="form-control form-control-sm" id="agentes_salida" name="agentes_salida" value="{{ isset( $dataposiciones ) ? $dataposiciones['agentes_salida'] : '5' }}" placeholder="Agentes salida" {{ array_key_exists( 'outbound', $datamodulo ) ? '' : 'readonly' }}>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group row">
            <label class="col-sm-5 col-form-label" for="agentes_full"><b>Agentes dual :</b></label>
            <div class="col-sm-7">
                <input type="number" min="1" max="200" class="form-control form-control-sm" id="agentes_full" name="agentes_full" value="{{ isset( $dataposiciones ) ? $dataposiciones['agentes_full'] : '5' }}" placeholder="Agentes dual" {{ array_key_exists( 'inbound', $datamodulo ) && array_key_exists( 'outbound', $datamodulo )  ? '' : 'readonly' }}>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="form-group row">
            <label class="col-sm-5 col-form-label" for="canal_mensajes_voz"><b>Mensajes de voz :</b></label>
            <div class="col-sm-7">
                <input type="number" min="1" max="200" class="form-control form-control-sm" id="canal_mensajes_voz" name="canal_mensajes_voz" value="{{ isset( $dataposiciones ) ? $dataposiciones['canal_mensajes_voz'] : '5' }}" placeholder="Mensajes de voz" {{ array_key_exists( 'voice_message', $datamodulo ) ? '' : 'readonly' }}>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group row">
            <label class="col-sm-5 col-form-label" for="canal_generador_encuestas"><b>Generador de encuestas :</b></label>
            <div class="col-sm-7">
                <input type="number" min="1" max="200" class="form-control form-control-sm" id="canal_generador_encuestas" name="canal_generador_encuestas" value="{{ isset( $dataposiciones ) ? $dataposiciones['canal_generador_encuestas'] : '5' }}" placeholder="Generador de encuestas" {{ array_key_exists( 'survey_generator', $datamodulo ) ? '' : 'readonly' }}>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="form-group row">
            <label class="col-sm-5 col-form-label" for="agentes_administrador"><b>Licencias administrador :</b></label>
            <div class="col-sm-7">
                <input type="number" min="1" max="10" class="form-control form-control-sm" id="agentes_administrador" name="agentes_administrador" value="{{ isset( $dataposiciones ) ? $dataposiciones['agentes_administrador'] : '5' }}" placeholder="Agentes administrador" value="1">
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group row">
            <label class="col-sm-5 col-form-label" for="licencias_ivr_inteligente"><b>Licencias IVR inteligente :</b></label>
            <div class="col-sm-7">
                <input type="number" min="1" max="200" class="form-control form-control-sm" id="licencias_ivr_inteligente" name="licencias_ivr_inteligente" value="{{ isset( $dataposiciones ) ? $dataposiciones['licencias_ivr_inteligente'] : '5' }}" placeholder="Licencias IVR inteligente" {{ array_key_exists( 'intelligent_ivr', $datamodulo ) ? '' : 'readonly' }}>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="form-group row">
            <label class="col-sm-5 col-form-label" for="licencias_softphone"><b>Licencias Softphone :</b></label>
            <div class="col-sm-7">
                <input type="number" min="1" max="200" class="form-control form-control-sm" id="licencias_softphone" name="licencias_softphone" value="{{ isset( $dataposiciones ) ? $dataposiciones['licencias_softphone'] : '5' }}" placeholder="Licencias Softphone">
            </div>
        </div>
    </div>
</div>

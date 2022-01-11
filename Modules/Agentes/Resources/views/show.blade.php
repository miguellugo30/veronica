<section class="content-header">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h1 class="card-title"><b><i class="fas fa-phone-volume"></i> Campaña: {{ ucwords( $campana->nombre ) }}</b></h1>
        </div><!--card-header-->
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <h5>
                        <small> DID: {{$calledid}}</small>
                        <input type="hidden" id="canal" name="canal" value="{{ $canal }}">
                        <input type="hidden" id="canal_entrante" name="canal_entrante" value="{{ $canal_entrante->canal }}">
                        <input type="hidden" id="uniqueid" name="uniqueid" value="{{ $uniqueid }}">
                    </h5>
                </div>
                <div class="col-4 text-center">
                    <button type="button" class="btn btn-success calificar-llamada">Calificar llamada</button>
                </div>
                <div class="col-4">
                    <ol class="breadcrumb float-right">
                        <li><h6><i class="far fa-clock"></i> Tiempo llamada:</h6></li>
                        <li><h6><b id="screen">00:00:46</b></h6></li>
                    </ol>
                </div>
            </div>
        </div><!--card-header-->
    </div><!--card-->
</section>

<section class="content viewResult" style="">
    <div class="row">
        <div class="col-6  h-100 d-inline-block" >
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b><i class="far fa-check-square"></i> Calificar llamada</b></h3>
                </div><!--card-header-->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-justify">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="calificaciones"><b>Calificación:</b></label>
                                        <select class="form-control form-control-sm" name="calificacion" id="calificacion">
                                            <option value="">Selecciona una calificacion</option>
                                            @foreach ($grupo->Calificaciones as $calificacion)
                                                <option data-calificacionId="{{$calificacion->id}}" value="{{$calificacion->Formularios_id}}">{{$calificacion->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 viewFormularioCalificacion" >

                            </div>
                        </div>
                    </div>
                </div><!--card-header-->
            </div><!--card-->
        </div>
        <div class="col-6">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b><i class="far fa-comment-dots"></i> Script</b></h3>
                </div><!--card-header-->
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-justify">
                            @if ( $speech->tipo == 'estatico' )
                                <div class="col">
                                    <h5>{{ $speech->nombre }}</h5>
                                    <p class="card-text text-justify">{{ $speech->texto }}</p>
                                </div>
                            @else
                                <div class="col">
                                    <h5 >{{ $speech->nombre }}</h5>
                                    <hr>
                                    <p class="card-text text-justify">{{ $bienvenida->texto }}</p>
                                    <hr>
                                    <div class="col text-center">
                                        @foreach ($campos as $opcion)
                                            @if ( $opcion->tipo == '0' )
                                                <button type="button" class="btn btn-primary btn-sm opcion" data-speech-id="{{$speech->id}}" data-id='{{ $opcion->speech_id_hijo }}'>{{ $opcion->nombre }}</button>
                                            @endif
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div id="opcion_seleccionada_{{$speech->id}}" class="col" style="display:none"></div>
                                </div>
                            @endif

                        </div><!-- /.col -->
                    </div> <!-- /.row -->
                </div><!--card-body-->
            </div><!--card-->
            <hr>

            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b><i class="fas fa-user-tie"></i> Datos del Cliente</b></h3>
                </div><!--card-header-->
                <div class="card-body">

                    <div class="row">
                        <div class="col-12 text-justify">
                            <h4>Sin información que mostrar</h4>
                        </div>
                        <!-- /.col -->
                    </div>

                </div><!--card-body-->
            </div><!--card-->

            <hr>

            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title"><b><i class="fas fa-user-clock"></i> Historial de llamadas del cliente</b></h3>
                </div><!--card-header-->
                <div class="card-body">

                    <div class="row">
                        <div class="col-12 text-justify">
                            <table class="table table-striped table-sm historico-llamadas">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Campaña</th>
                                        <th>Fecha</th>
                                        <th>Calificacion</th>
                                        <th>Agente</th>
                                        <th>Estatus</th>
                                        <th>Ver</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($historico as $his)
                                        <tr>
                                            <td>{{ $his->campana }}</td>
                                            <td>{{  date( 'd-m-Y H:i:s', strtotime( $his->fecha_inicio ) )  }}</td>
                                            <td>{{ $his->callerid }}</td>
                                            <td>{{ $his->nombre }}</td>
                                            <td class="text-center"><i class="fas fa-check text-success"></i></td>
                                            <td><i class="far fa-plus-square text-primary"></i></td>
                                        </tr>
                                    @endforeach
                                    @for ($i = 0; $i < count( $historico  ); $i++)
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                        <!-- /.col -->
                    </div>

                </div><!--card-body-->
            </div><!--card-->

        </div>
    </div>
</section>
<script>
    $(function() {

        pantalla = document.getElementById("screen");
        var isMarch = false;
        var acumularTime = 0;

        if (isMarch == false) {
            timeInicial = new Date();
            control = setInterval(cronometro,10);
            isMarch = true;
        }

        function cronometro () {
            timeActual = new Date();
            acumularTime = timeActual - timeInicial;
            acumularTime2 = new Date();
            acumularTime2.setTime(acumularTime);
            cc = Math.round(acumularTime2.getMilliseconds()/10);
            ss = acumularTime2.getSeconds();
            mm = acumularTime2.getMinutes();
            hh = acumularTime2.getHours()-18;
            if (ss < 10) {ss = "0"+ss;}
            if (mm < 10) {mm = "0"+mm;}
            if (hh < 10) {hh = "0"+hh;}
            pantalla.innerHTML = hh+" : "+mm+" : "+ss;
        }

    });
</script>

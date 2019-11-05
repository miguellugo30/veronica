<section class="content-header" style="margin-right:50px">
    <div class="row">
        <div class="col-4">
            <h4>
                <b>{{ ucwords( $campana->nombre ) }}</b>
                <small>{{$calledid}}</small>
                <input type="hidden" id="canal" name="canal" value="{{ $canal }}">
            </h4>
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
</section>

<section class="content viewResult" style="margin-right:50px">
    <div class="row">
            <div class="col-8  h-100 d-inline-block">
                <div class="box" >
                    <div class="box-header with-border">
                        <h3 class="box-title"><b>Calificar llamada</b></h3>
                        <div class="box-tools pull-right">
                            <!--button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button-->
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-12 text-justify">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="calificaciones"><b>Calificacion</b></label>
                                            <select class="form-control form-control-sm" name="calificacion" id="calificacion">
                                                <option value="">Selecciona una calificacion</option>
                                                @foreach ($grupo->Calificaciones as $calificacion)
                                                    <option value="{{$calificacion->Formularios_id}}">{{$calificacion->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 viewFormularioCalificacion" >

                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./box-body -->
                </div>
                <!-- /.box -->
            </div>
        <div class="col-4">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Datos del Cliente</b></h3>
                    <div class="box-tools pull-right">
                        <!--button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button-->
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-12 text-justify">
                            <p>Occaecat do consectetur mollit labore. Laboris reprehenderit quis voluptate pariatur qui. Pariatur veniam dolore tempor culpa quis occaecat ex aliqua id eu occaecat excepteur deserunt. Minim esse nostrud anim culpa anim mollit fugiat sunt. Consectetur in culpa quis esse nisi amet qui aute cupidatat ullamco sit in esse. Laboris sunt aute irure eu esse duis aliquip amet velit ad minim commodo laborum laboris. Deserunt veniam nisi id cillum consectetur irure nisi culpa anim.</p>
                            <p>Consequat velit velit irure reprehenderit enim culpa amet ut. Id cillum exercitation voluptate deserunt qui dolore aute aliqua enim proident. Non non occaecat eiusmod id. Fugiat exercitation do esse veniam id eiusmod deserunt. Ullamco duis ullamco Lorem sunt sunt commodo labore exercitation.</p>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- ./box-body -->
            </div>
            <!-- /.box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Script</b></h3>
                    <div class="box-tools pull-right">
                        <!--button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button-->
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-12 text-justify">
                        <p><b>{{ $speech->nombre }}</b></p>

                        <p>{{ $speech->Opciones_Speech[0]->texto }}</p>

                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- ./box-body -->
            </div>
            <!-- /.box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><b>Historial de llamadas del cliente</b></h3>
                    <div class="box-tools pull-right">
                        <!--button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button-->
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
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
                    <!-- /.row -->
                </div>
                <!-- ./box-body -->
            </div>
            <!-- /.box -->
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

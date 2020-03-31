<style>
    .hora{
        background-color: white;
        display: inline-flex;
        border: 1px solid #ccc;
        color: #555;
    }
    .hora input{
        border: none;
        color: #555;
        text-align: center;
        width: 50px;
        height: 29px;
    }
</style>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><b><i class="fas fa-filter"></i> Filtro</b></h3>
        <div class="box-tools pull-right">
            <button class='btn btn-primary btn-sm nuevo-reporte' style='display:none'>
                Nuevo Reporte
            </button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body filtro-reporte">
        <div class="row">
            <div class="col">
                <div class="alert alert-dark col text-center" role="alert">
                    <b>Filtros por fecha</b>
                    @csrf
                </div>
                <div class="row ">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="fecha-inicio" class="col-sm-5 col-form-label col-form-label-sm"><b>Fecha Inicio:</b></label>
                            <div class="col-sm-7">
                                <input type="date" class="form-control form-control-sm" name="fecha-inicio" id="fecha-inicio" placeholder="Fecha Inicio">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="fecha-fin" class="col-sm-5 col-form-label col-form-label-sm"><b>Fecha Fin:</b></label>
                            <div class="col-sm-7">
                                <input type="date" class="form-control form-control-sm" name="fecha-fin" id="fecha-fin" placeholder="Fecha Fin">
                            </div>
                        </div>
                    </div><!-- /.col-md-4 -->
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="hora-inicio" class="col-sm-5 col-form-label col-form-label-sm"><b>Hora Inicio:</b></label>
                            <div class="col-sm-6 hora">
                                <input type="number" name="hora_inicio_1" id="hora_inicio" min="00" max="23" value="00" class="form-control form-control-sm" placeholder="--" size="2" onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;">:
                                <input type="number" name="min_inicio_1" id="min_inicio"  min="0" max="59" value="00" class="form-control form-control-sm" placeholder="--" size="2" onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hora-fin" class="col-sm-5 col-form-label col-form-label-sm"><b>Hora Fin:</b></label>
                            <div class="col-sm-6 hora">
                                <input type="number" name="hora_fin_1" id="hora_fin" min="0" max="23" value="23" class="form-control form-control-sm" placeholder="--" onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;">:
                                <input type="number" name="min_fin_1" id="min_fin"  min="0" max="59" value="59" class="form-control form-control-sm" placeholder="--" onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;">
                            </div>
                        </div>
                    </div><!-- /.col-md-4 -->
                </div><!-- /.row -->
            </div>
            <div class="col">
                <div class="alert alert-dark col text-center" role="alert">
                    <b>Filtros por Agente / Grupo / Campaña</b>
                </div>
                <div class="col-md-12">
                    <div class="form-group row">
                        <label for="agente" class="col-sm-2 col-form-label col-form-label-sm"><b>Agentes:</b></label>
                        <div class="col-9 ml-4">
                            <select name="agente" id="agente" class="form-control form-control-sm agente-grupo">
                                <option value="0">Selecciona un agente</option>
                                @foreach ($agentes as $agente)
                                    <option value="{{$agente->id}}">{{$agente->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="grupo" class="col-sm-2 col-form-label col-form-label-sm"><b>Grupo:</b></label>
                        <div class="col-9 ml-4">
                            <select name="grupo" id="grupo" class="form-control form-control-sm agente-grupo">
                                <option value="0">Selecciona una opción</option>
                                @foreach ($grupos as $grupo)
                                    <option value="{{$grupo->id}}">{{$grupo->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div><!-- /.col-md-10 -->
            </div>
            <div class="col-12">
                <div class="row ">
                    <div class="col-12">
                        <div class="alert alert-dark col" role="alert">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="llamadas" name="llamadas">
                                <label class="form-check-label" for="llamadas">
                                    <b>Llamadas</b>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check ml-4">
                            <input class="form-check-input checkbox-llamadas" type="checkbox" value="" id="recibidas" name="llamadas-recibidas">
                            <label class="form-check-label" for="llamadas-recibidas">
                                Recibidas
                            </label>
                        </div>
                    </div><!-- /.col -->
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input checkbox-llamadas" type="checkbox" value="" id="contestadas" name="llamadas-contestadas">
                            <label class="form-check-label" for="llamadas-contestadas">
                                Contestadas
                            </label>
                        </div>
                    </div><!-- /.col -->
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input checkbox-llamadas" type="checkbox" value="" id="omitidas" name="llamadas-omitidas">
                            <label class="form-check-label" for="llamadas-omitidas">
                                Omitidas
                            </label>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.col-12 -->
            <div class="col-12 mt-3">
                <div class="row ">
                    <div class="col-12">
                        <div class="alert alert-dark col" role="alert">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="tiempos" name="tiempos">
                                <label class="form-check-label" for="tiempos">
                                    <b>Tiempos</b>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check ml-4">
                            <input class="form-check-input checkbox-tiempos" type="checkbox" value="2" id="tiempo-disponible" name="tiempo-logueo">
                            <label class="form-check-label" for="tiempo-logueo">
                                Tiempo Disponible
                            </label>
                        </div>
                        <div class="form-check ml-4">
                            <input class="form-check-input checkbox-tiempos" type="checkbox" value="11" id="tiempo-logueo" name="tiempo-logueo">
                            <label class="form-check-label" for="tiempo-logueo">
                                Tiempo logueado
                            </label>
                        </div>
                    </div><!-- /.col -->
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input checkbox-tiempos" type="checkbox" value="3" id="tiempo-no-disponible" name="tiempo-no-disponible">
                            <label class="form-check-label" for="tiempo-no-disponible">
                                Tiempo no disponible total
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input checkbox-tiempos" type="checkbox" value="10" id="tiempo-marcador-manual" name="marcador-manual">
                            <label class="form-check-label" for="tiempo-marcador-manual">
                                Tiempo marcador manual
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input checkbox-tiempos" type="checkbox" value="5" id="tiempo-llamada-programada" name="marcador-manual">
                            <label class="form-check-label" for="tiempo-llamada-programada">
                                Tiempo llamada programada
                            </label>
                        </div>
                    </div><!-- /.col -->
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input checkbox-tiempos" type="checkbox" value="8" id="tiempo-en-llamada-inbound" name="tiempo-inbound">
                            <label class="form-check-label" for="tiempo-en-llamada-inbound">
                                Tiempo en llamada inbound
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input checkbox-tiempos" type="checkbox" value="12" id="tiempo-definiendo-llamada-inbound" name="tiempo-definiendo-inbound">
                            <label class="form-check-label" for="tiempo-definiendo-inbound">
                                Tiempo definiendo llamada inbound
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input checkbox-tiempos" type="checkbox" value="0" id="tiempo-total-inbound" name="tiempo-total-inbound">
                            <label class="form-check-label" for="tiempo-total-inbound">
                                Tiempo total inbound
                            </label>
                        </div>
                    </div><!-- /.col -->
                    <div class="col">
                        <div class="form-check">
                            <input class="form-check-input checkbox-tiempos" type="checkbox" value="4" id="tiempo-en-llamada-outbound" name="tiempo-outobund">
                            <label class="form-check-label" for="tiempo-en-llamada-outobund">
                                Tiempo en llamada Outbound
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input checkbox-tiempos" type="checkbox" value="13" id="tiempo-definiendo-llamada-outbound" name="tiempo-definiendo-outbound">
                            <label class="form-check-label" for="tiempo-definiendo-outbound">
                                Tiempo definiendo llamada Outbound
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input checkbox-tiempos" type="checkbox" value="1" id="tiempo-total-outbound" name="tiempo-total-outbound">
                            <label class="form-check-label" for="tiempo-total-outbound">
                                Tiempo total Outbound
                            </label>
                        </div>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.col-12 -->
        </div><!-- /.row -->
        <br><br>
        <div class="row justify-content-md-center">
            <button type="submit" class="btn btn-primary generarReporteProductividadAgentes">Generar</button>
        </div>
    </div><!-- ./box-body -->
</div>

<div class="viewReporte"></div>

<iframe id="iFrameDescarga" src="" frameborder="0" style="display:none"></iframe>

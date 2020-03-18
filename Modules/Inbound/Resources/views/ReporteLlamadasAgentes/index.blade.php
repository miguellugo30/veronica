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
    <div class="box-body">
        <div class="row filtro-reporte justify-content-md-center">
            <div class="col-8 viewIndex">
                <div class="container">
                    <div class="row justify-content-md-center">
                        <div class="alert alert-dark col-10" role="alert">
                            <b>Filtros por fecha</b>
                            @csrf
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="col-md-5">
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
                        <div class="col-md-5">
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
                        <div class="w-100"></div>
                        <div class="col-md-10">
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
                        </div><!-- /.col-md-4 -->
                        <div class="w-100"></div>
                        <div class="col-md-10">
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
                        </div><!-- /.col-md-4 -->
                        <div class="w-100"></div>
                        <div class="col-md-10">
                            <div class="form-group row">
                                <label for="campana" class="col-sm-2 col-form-label col-form-label-sm"><b>Campaña:</b></label>
                                <div class="col-9 ml-4">
                                    <select name="campana" id="campana" class="form-control form-control-sm">
                                        <option value="0">Selecciona una opción</option>
                                        @foreach ($campanas as $campana)
                                            <option value="{{$campana->id}}">{{$campana->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div><!-- /.col-md-4 -->
                    </div>

                    <br>
                    <div class="row justify-content-md-center">
                        <button type="submit" class="btn btn-primary generarReporteLlamadasAgentes">Generar</button>
                    </div>
                </div>
            </div><!-- /.col-6 -->
        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div>

<div class="viewReporte"></div>

<iframe id="iFrameDescarga" src="" frameborder="0" style="display:none"></iframe>

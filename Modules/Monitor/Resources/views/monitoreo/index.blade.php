<style>
    .list-group-item{
        cursor: pointer;
    }
</style>
<div class="row">
    <section class="col-lg-2">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><b><i class="fas fa-users"></i></i> Grupo de Agentes</b></h3>
                <div class="box-tools pull-right"></div>
            </div><!-- /.box-header -->
            <div class="box-body viewGrupoAgentes">
                <input type="hidden" name="grupo-selec" id="grupo-selec" value="">
                <ul class="list-group list-group-flush">
                    <li data-id="0" class="list-group-item list-group-item-action"><i class="fas fa-genderless"></i> Todos los agentes</li>
                    @foreach ($grupos as $grupo)
                        <li data-id="{{$grupo->id}}" class="list-group-item list-group-item-action"><i class="fas fa-genderless"></i> {{$grupo->nombre}}</li>
                    @endforeach
                  </ul>
            </div><!-- ./box-body -->
        </div>
    </section>
    <section class="col-lg-5">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><b><i class="fas fa-list"></i> Listado de Agentes</b></h3>
                <div class="box-tools pull-right"></div>
            </div><!-- /.box-header -->
            <div class="box-body viewListadoAgentes">
            </div><!-- ./box-body -->
        </div>
    </section>
    <section class="col-lg-5">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><b><i class="fas fa-user-secret"></i> Monitoreo de Agentes</b></h3>
                <div class="box-tools pull-right"></div>
            </div><!-- /.box-header -->
            <div class="box-body viewMonitoreoAgentes">
                <form>
                    @csrf
                    <div class="form-group">
                        <label for="num_monitoreo"><b>Numero o Ext. para monitoreo:</b></label>
                        <input type="text" class="form-control form-control-sm" id="num_monitoreo" placeholder="Numero o Ext. para monitoreo" value="5215537183682">
                    </div>
                    <div class="form-group">
                        <label for="tiempo_rotacion"><b>Tiempo de rotación ( Mayor a 15 seg. ):</b></label>
                        <input type="number" min="15" class="form-control form-control-sm" id="tiempo_rotacion" placeholder="15 seg">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="sin_tiempo_rotacion">
                        <label class="form-check-label" for="sin_tiempo_rotacion"><b>Sin tiempo de rotación.</b></label>
                    </div>
                    <div class="form-group">
                        <label for="llamadas_mayores"><b>Monitorear llamadas mayores a:</b></label>
                        <select name="llamadas_mayores" id="llamadas_mayores" class="form-control form-control-sm">
                            <option value="15">15 Segundos</option>
                            <option value="30">30 Segundos</option>
                            <option value="45">45 Segundos</option>
                            <option value="60">60 Segundos</option>
                        </select>
                    </div>
                    <button class="btn btn-primary btn-sm" id="iniciar-monitoreo">Iniciar Monitoreo</button>
                    <button class="btn btn-danger btn-sm" id="detener-monitoreo" style="display:none">Detener Monitoreo</button>
                    <button class="btn btn-info btn-sm" id="siguiente-monitoreo" style="display:none">Siguiente agente</button>
                    <button class="btn btn-primary btn-sm" id="iniciar-coaching" style="display:none" disabled>Coaching</button>
                    <button class="btn btn-warning btn-sm" id="iniciar-conferencia" style="display:none" disabled>Conferencia</button>
                </form>
            </div><!-- ./box-body -->
        </div>
    </section>
</div>

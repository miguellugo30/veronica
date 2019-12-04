<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fas fa fa-filter"></i> Filtro</h3>
          <div class="center p1 bg-blue" role="alert" style="text-align:center;">Filtrar Por:</div>
        <div class="box-tools pull-right">
                {{--@can('delete grabaciones')
                <button type="button" class="btn btn-danger  btn-sm deleteGrabacion" style="display:none"><i class="fas fa-trash-alt"></i> Eliminar</button>
                @endcan
                @can('create grabaciones')
                <button type="button" class="btn btn-primary btn-sm downloadGrabacion" style="display:none" data-widget="remove"><i class="fas fa-plus"></i> Descargar</button>
                @endcan--}}
            <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="">
        </div>
        <form enctype="multipart/form-data" id="filtargrabaciones" method="post">
        <div class="form-row">
                <div class="form-group col-md-3">
                </div>
                <div class="form-group col-md-2">
                        <label class="mr-sm-2 mb-0" for="campana"><b>Campaña:</b></label>
                        <select class="form-control form-control-sm campana" name="campana" id="campana">
                            <option>Seleccione una Campaña</option>
                                @foreach ($campanas as $campana)
                                <option value="{{ $campana->id }}">{{ $campana->nombre }}</option>
                                @endforeach
                        </select>
                        @csrf
                </div>
                <div class="form-group col-md-2">
                        <label class="mr-sm-2 mb-0" for="agente"><b>Agente:</b></label>
                        <select class="form-control form-control-sm agente" name="agente" id="agente" disabled>
                            <option>Selecciona un Agente</option>
                                {{--@foreach ($nombres as $nombre)
                                <option value="{{ $nombre->id }}">{{ $nombre->nombre }}</option>
                                @endforeach--}}
                        </select>
                </div>
                <div class="form-group col-md-2">
                    <label class="mr-sm-2 mb-0" for="extension"><b>Extension:</b></label>
                    <select class="form-control form-control-sm extension" name="extension" id="extension" disabled>
                        <option>Selecciona una Extension</option>
                    </select>
                </div>
                <div class="form-group col-md-3">
                </div>
                <div class="form-group col-md-3">
                </div>
                <div class="form-group col-md-2">
                    <label class="mr-sm-2 mb-0" for="numOrigen"><b>Numero Origen:</b></label>
                    <input class="form-control form-control-sm" type="text" value="" name="numOrigen" id="numOrigen"/>
                </div>
                <div class="form-group col-md-2">
                    <label class="mr-sm-2 mb-0" for="fechaIni"><b>Fecha Inicio:</b></label>
                    <input class="form-control form-control-sm" type="date" value="<?php echo date('Y-m-d'); ?>" name="fechaIni" id="fechaIni"/>
                </div>
                <div class="form-group col-md-2">
                    <label class="mr-sm-2 mb-0" for="hrIni"><b>Hora Inicio:</b></label>
                    <input class="form-control form-control-sm" type="time" value="00:00" name="hrIni" id="hrIni"/>
                </div>
                <div class="form-group col-md-2">
                </div>
                <div class="form-group col-md-2">
                </div>
                <div class="form-group col-md-1">
                    </div>
                <div class="form-group col-md-2">
                    <label class="mr-sm-2 mb-0" for="numDestino"><b>Numero Destino:</b></label>
                    <input class="form-control form-control-sm" type="text" value="" name="numDestino" id="numDestino"/>
                </div>
                <div class="form-group col-md-2">
                        <label class="mr-sm-2 mb-0" for="fechaFin"><b>Fecha Fin:</b></label>
                        <input class="form-control form-control-sm" type="date" value="<?php echo date('Y-m-d'); ?>" name="fechaFin" id="fechaFin"/>
                </div>
                <div class="form-group col-md-2">
                        <label class="mr-sm-2 mb-0" for="hrFin"><b>Hora Fin:</b></label>
                        <input class="form-control form-control-sm" type="time" value="23:59" name="hrFin" id="hrFin"/>
                </div>
                <div class="form-group col-md-3">
                </div>
                <div class="form-group col-md-3">
                </div>
                <div class="form-group col-md-2">
                        <label class="mr-sm-2 mb-0" for="estatus"><b>Estatus de la Grabacion:</b></label>
                        <select class="form-control form-control-sm" name="estatus" id="estatus">
                            <option>Seleccione una Opcion</option>
                                <option value="1">En el servidor de Grabaciones</option>
                                <option value="2">En mi servidor FTP</option>
                                <option value="3">Grabaciones Eliminadas</option>
                        </select>
                </div>

                <div class="form-group col-md-2">
                        <label class="mr-sm-2 mb-0" for="calificacion"><b>Calificacion:</b></label>
                        <select class="form-control form-control-sm calificacion" name="calificacion" id="calificacion" disabled>
                            <option>Seleccione una Calificacion</option>
                                {{--@foreach ($calificaciones_id as $calificacion_id)
                                <option value="{{ $calificacion_id->Calificaciones_id }}">{{ $calificacion_id->Calificaciones_id }}</option>
                                @endforeach--}}
                        </select>
                </div>
                <div class="form-group col-md-2">
                        <label class="mr-sm-2 mb-0" for="subcalificacion"><b>Subcalificacion:</b></label>
                        <select class="form-control form-control-sm subcalificacion" name="subcalificacion" id="subcalificacion" disabled>
                            <option>Seleccione una Subcalificacion</option>
                                {{--@foreach ($subcalificaciones as $subcalificacion)
                                <option value="{{ $subcalificacion->id }}">{{ $subcalificacion->nombre }}</option>
                                @endforeach--}}
                        </select>
                </div>
                <div class="form-group col-md-6">
                </div>
                <button type="submit" class="btn btn-primary filtrar">Filtrar</button>
        </div>
        </form>
    </div>
    <hr>
    <div class="resultado">

    </div>
</div>



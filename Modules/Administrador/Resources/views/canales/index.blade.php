<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fas fa-project-diagram"></i> Canales</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary btn-xs newCanal" data-widget="remove"><i class="fas fa-plus"></i> Nuevo Canal</button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 viewIndex">
                <table id="tableCanales" class="display table table-striped table-condensed" style="width:100%">
                    <thead>
                        <tr>
                            <th>Distribuidor</th>
                            <th>Empresa</th>
                            <th>Troncal</th>
                            <th>Tipo de Canal</th>
                            <th>Canal</th>
                        </tr>
                    </thead>
                    <!-- Iterar el arreglo $canales que contiene el resultado de consultar todos los registros que contiene la tabla de Canales
                    :: Nombre de Distribuidor
                    :: Nombre de Empresa
                    :: Troncal
                    :: Tipo de canal
                    :: Canal
                    -->
                    <tbody>
                        @foreach ($canales as $canal)
                            <tr data-id="{{ $canal->id }}">
                                <td>{{ $canal->Distribuidores->servicio }}</td>
                                <td>{{ $canal->Empresas->nombre }}</td>
                                <td>{{ $canal->Troncales->nombre }}</td>
                                <td>
                                    @if($canal->tipo==1)
                                        Offnet(Salida)
                                    @elseif($canal->tipo==2)
                                        Onnet (Interno entre Ext)
                                    @elseif($canal->tipo==3)
                                        DID (Entrante)
                                    @elseif($canal->tipo==4)
                                        Onnet (Integracion)
                                    @elseif($canal->tipo==5)
                                        DIDFAKE (Integracion)
                                    @endif
                                </td>
                                <td>{{ $canal->canal }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-12 viewCreate"></div>
        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div>

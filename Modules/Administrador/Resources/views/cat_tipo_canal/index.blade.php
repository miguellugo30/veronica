<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><b><i class="fas fa-phone"></i> Tipos de Canales</b></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary btn-xs newTipoCanal" data-widget="remove"><i class="fas fa-plus"></i>  Nuevo Tipo Canal</button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 viewIndex">
                <table id="tableTiposCanal" class="display table table-striped table-condensed" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Distribuidor</th>
                            <th>Prefjo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tipocanales as $tipocanal)
                            <tr data-id="{{ $tipocanal->id }}">
                                <td>{{$tipocanal->nombre}}</td>
                                <td>{{$tipocanal->Cat_Distribuidor->servicio}}</td>
                                <td>{{$tipocanal->prefijo}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-12 viewCreate"></div>
        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fas fa-building"></i> Empresas</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary btn-xs newEmpresa" data-widget="remove"><i class="fas fa-plus"></i> Nueva empresa</button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 viewIndex">
                <table id="tableEmpresas" class="display table table-striped table-condensed" >
                    <thead>
                        <tr>
                            <th>ID Cliente</th>
                            <th>Distribuidor</th>
                            <th>Nombre</th>
                            <th>Ubicación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empresas as $empresa)
                            <tr data-id="{{ $empresa->id }}">
                                <td>{{$empresa->id}}</td>
                                <td>{{ $empresa->Config_Empresas->Distribuidores->servicio }}</td>
                                <td>{{$empresa->nombre}}</td>
                                <td>{{$empresa->nombre}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-12 viewCreate"></div>
        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div>

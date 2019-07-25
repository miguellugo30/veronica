<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><b><i class="fas fa-database"></i> Bases de Datos</b></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary btn-sm newDataBase" data-widget="remove"><i class="fas fa-plus"></i> Nueva Base de Datos</button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 viewIndex">
                <table id="tableBaseDatos" class="display table table-striped table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>Ubicación</th>
                            <th>Nombre</th>
                            <th>IP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($basesDatos as $basesDato)
                            <tr data-id="{{ $basesDato->id }}">
                                <td>{{$basesDato->ubicacion}}</td>
                                <td>{{$basesDato->nombre}}</td>
                                <td>{{$basesDato->ip}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-12 viewCreate"></div>
        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div>

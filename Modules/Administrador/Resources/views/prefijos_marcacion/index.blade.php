<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fas fa-atlas"></i> Prefijos de Marcacion</h3>
        <div class="box-tools pull-right">
            <!--button type="button" class="btn btn-primary btn-xs nuevoPrefijo" data-widget="remove"><i class="fas fa-plus"></i> Nuevo Prefijo</button-->
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-12 viewIndex">
                <table id="tablePrefijosMarcacion" class="display table table-bordered table-hover table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>Editar</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Prefijo</th>
                            <th>Prefijo Nuevo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $Prefijos as $prefijo )
                            <tr data-id="{{ $prefijo->id }}">
                                <td>{{ $prefijo->nombre }}</td>
                                <td>{{$prefijo->descripcion }}</td>
                                <td>{{ $prefijo->prefijo }}</td>
                                <td>{{ $prefijo->prefijo_nuevo }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-12 viewCreate"></div>
        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div>

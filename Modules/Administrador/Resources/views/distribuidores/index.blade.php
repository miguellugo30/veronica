<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fas fa-truck"></i> Distribuidores</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary btn-xs nuevoDistribuidor" data-widget="remove"><i class="fas fa-plus"></i> Nuevo distribuidor</button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 viewIndex" >
                <table id="tableDistribuidores" class="display table table-striped table-condensed" style="width:100%">
                    <thead>
                        <tr>
                            <th>Servicio</th>
                            <th>Distribuidor</th>
                            <th>Numero Soporte</th>
                            <th>Prefijo</th>
                            <th>Imagen encabezado</th>
                            <th>Imagen pie</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $Distribuidores as $distribuidor )
                            <tr data-id="{{ $distribuidor->id }}">
                                <td>{{ $distribuidor->servicio }}</td>
                                <td>{{ $distribuidor->distribuidor }}</td>
                                <td>{{ $distribuidor->numero_soporte }}</td>
                                <td>{{ $distribuidor->prefijo }}</td>
                                <td><a href="{{ Storage::url($distribuidor->img_header)}}" target="_blank"><img width="100px" src="{{ Storage::url($distribuidor->img_header) }}"></a></td>
                                <td><a href="{{ Storage::url($distribuidor->img_pie) }}"   target="_blank"><img width="100px" src="{{ Storage::url($distribuidor->img_pie) }}"></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-12 viewCreate"></div>
        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div>

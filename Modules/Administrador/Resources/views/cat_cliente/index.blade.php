<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><b><i class="fas fa-phone"></i> Estados de Cliente</b></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary btn-xs newEdoCli" data-widget="remove"><i class="fas fa-plus"></i> Nuevo Catalogo</button>
            <button type="button" class="btn btn-primary btn-xs orderignEdoCli" data-widget="remove"><i class="fas fa-sort-numeric-down"></i> Ordenar Catalogo</button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 viewIndex">
                <table id="tableEdoCli" class="display table table-striped table-condensed" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Marcar</th>
                            <th>Mostrar Agente</th>
                            <th>Parametrizar</th>
                            <th>Orden</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cat_clientes as $cat_cliente)
                            <tr data-id="{{ $cat_cliente->id }}">
                                <td>{{ $cat_cliente->nombre }}</td>
                                <td>{{ $cat_cliente->descripcion }}</td>
                                <td>{{ ( $cat_cliente->marcar == 'y' ) ? "Si" : "No" }}</td>
                                <td>{{ ( $cat_cliente->mostrar_agente  == 'y' ) ? "Si" : "No" }}</td>
                                <td>{{ ( $cat_cliente->parametrizar ) ? "Si" : "No" }}</td>
                                <td>{{ $cat_cliente->orden }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-12 viewCreate"></div>
        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div>

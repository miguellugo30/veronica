<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fas fa-align-justify"></i> Menús</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary btn-xs newCat" data-widget="remove"><i class="fas fa-plus"></i> Nuevo Menú</button>
            <button type="button" class="btn btn-primary btn-xs orderignCat" data-widget="remove"><i class="fas fa-plus"></i> Ordenar Menú</button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-12 viewIndex">
                <div class="col-md-12 viewTable">
                    <table id="tableMenus" class="display table table-striped table-condensed" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Prioridad</th>
                                <th>tipo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categorias as $categoria)
                                <tr data-id="{{ $categoria->id }}">
                                    <td>{{ $categoria->nombre }}</td>
                                    <td>{{ $categoria->descripcion }}</td>
                                    <td>{{ $categoria->prioridad }}</td>
                                    <td>
                                        @if ($categoria->tipo == 1)
                                            Sistema
                                        @else
                                            Clientes
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6 viewSubCat" ></div>

            <div class="col-12 viewCreate"></div>
        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fas fa-th"></i> Módulos</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary btn-xs newModule" data-widget="remove"><i class="fas fa-plus"></i> Nuevo Modulo</button>
            <button type="button" class="btn btn-primary btn-xs orderignModule" data-widget="remove"> <i class="fas fa-sort-numeric-down"></i> Ordenar Modulo</button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 viewIndex">
                <table id="tableModulos" class="display table table-striped table-condensed" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Prioridad</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($modulos as $modulo)
                            <tr data-id="{{ $modulo->id }}">
                                <td>{{ $modulo->nombre }}</td>
                                <td>{{ $modulo->descripcion }}</td>
                                <td>{{ $modulo->prioridad }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-12 viewCreate"></div>
        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div>


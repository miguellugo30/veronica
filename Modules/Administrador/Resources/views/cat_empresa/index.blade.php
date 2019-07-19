<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fas fa-th"></i> Estados de Empresa</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary btn-xs newEdoEmp" data-widget="remove"><i class="fas fa-plus"></i> Nuevo catalogo</button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 viewIndex">
                <table id="tableEdoEmp" class="display table table-striped table-condensed" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cat_empresas as $cat_empresa)
                            <tr data-id="{{ $cat_empresa->id }}">
                                <td>{{ $cat_empresa->nombre }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-12 viewCreate"></div>
        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div>

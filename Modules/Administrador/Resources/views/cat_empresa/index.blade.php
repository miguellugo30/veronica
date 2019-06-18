<div class="col-12 viewIndex">
    <fieldset >
        <legend>
            <i class="fas fa-th"></i>
            Catalogo Estado Empresa
            <button type="button" class="btn btn-primary btn-xs newEdoEmp" style="float: right;margin-left: 5px;">
                <i class="fas fa-plus"></i>
                Nuevo catalogo
            </button>
        </legend>
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
    </fieldset>
</div>

<div class="col-12 viewCreate"></div>

<div class="col-12 viewIndex">
    <fieldset >
        <legend>
            <i class="fas fa-project-diagram"></i>
            Catalogo de Canales
            <button type="button" class="btn btn-primary btn-xs newCanal" style="float: right;margin-left: 5px;">
                <i class="fas fa-plus"></i>
                Nuevo Canal
            </button>
        </legend>
        <table id="tableCanales" class="display table table-striped table-condensed" style="width:100%">
                <thead>
                    <tr>
                        <th>Canal</th>
                        <th>Troncal</th>
                        <th>Distribuidor</th>
                        <th>Empresa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($canales as $canal)
                        <tr data-id="{{ $canal->id }}">
                            <td>{{ $canal->canal }}</td>
                            <td>{{ $canal->Troncales->nombre }}</td>
                            <td>{{ $canal->Distribuidores->servicio }}</td>
                            <td>{{ $canal->Empresas->nombre }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </fieldset>
</div>

<div class="col-12 viewCreate"></div>

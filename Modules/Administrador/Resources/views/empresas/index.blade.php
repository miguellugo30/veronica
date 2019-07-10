<div class="col-12 viewIndex">
    <fieldset >
        <legend>
            <i class="far fa-building"></i>
            Empresas
            <button type="button" class="btn btn-primary btn-xs newEmpresa" style="float: right;margin-left: 5px;">
                <i class="fas fa-plus"></i>
                Nueva Empresa
            </button>
        </legend>
        <table id="tableEmpresas" class="display table table-striped table-condensed" style="width:100%">
                <thead>
                    <tr>
                        <th>Distribuidor</th>
                        <th>ID Cliente</th>
                        <th>Nombre</th>
                        <th>Ubicación</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empresas as $empresa)
                        <tr data-id="{{ $empresa->id }}">
                            <td>{{ $empresa->Config_Empresas->Distribuidores->servicio }}</td>
                            <td>{{$empresa->id}}</td>
                            <td>{{$empresa->nombre}}</td>
                            <td>{{$empresa->nombre}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </fieldset>
</div>

<div class="col-12 viewCreate"></div>

<div class="col-12 viewIndex">
    <fieldset>
        <legend>
            <i class="fas fa-users"></i> Usuarios
            <button type="button" class="btn btn-primary btn-xs newUser" style="float: right;">
                <i class="fas fa-user-plus"></i>
                Nuevo distribuidor
            </button>
        </legend>

        <div class="col-md-12">
            <table id="tableDistribuidores" class="display table table-striped table-condensed" style="width:100%">
                <thead>
                    <tr>
                        <th>Servicio</th>
                        <th>Distribuidor</th>
                        <th>Numero Soporte</th>
                        <th>Imagen Alta</th>
                        <th>Imagen pie</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $Distribuidores as $distribuidor )
                        <tr data-id="{{ $distribuidor->id }}">
                            <td>{{ $distribuidor->servicio }}</td>
                            <td>{{ $distribuidor->distribuidor }}</td>
                            <td>{{ $distribuidor->numero_soporte }}</td>
                            <td>{{ $distribuidor->img_header }}</td>
                            <td>{{ $distribuidor->img_pie }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </fieldset>
</div>

<div class="col-12 viewCreate"></div>

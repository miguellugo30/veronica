<div class="col-12 viewIndex">
    <fieldset>
        <legend>
            <i class="fas fa-truck"></i> Distribuidor
            <button type="button" class="btn btn-primary btn-xs nuevoDistribuidor" style="float: right;">
                <i class="fas fa-plus"></i>
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
                            <td><a href="{{ Storage::url($distribuidor->img_header)}}" class="btn btn-primary active" target="_blank"><i class="far fa-eye"></i></a></td>
                            <td><a href="{{ Storage::url($distribuidor->img_pie) }}" class="btn btn-primary active" target="_blank"><i class="far fa-eye"></i></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </fieldset>
</div>

<div class="col-12 viewCreate"></div>

<div class="col-12 viewIndex">
    <fieldset>
        <legend>
            <i class="fas fa-phone"></i>
            DID
            <button type="button" class="btn btn-primary btn-xs nuevoDid" style="float: right;">
                <i class="fas fa-plus"></i>
                Nuevo did
            </button>
        </legend>

        <div class="col-md-12">
            <table id="tableDid" class="display table table-striped table-condensed" style="width:100%">
                <thead>
                    <tr>
                        <th>Empresa</th>
                        <th>Tipo</th>
                        <th>Prefijo</th>
                        <th>Did</th>
                        <th>Descripcion</th>
                        <th>Troncal Sansay</th>
                        <th>Gateway</th>
                        <th>Fakedid</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $Dids as $did )
                        <tr data-id="{{ $did->id }}">
                            <td>{{ $did->Empresas->nombre }}</td>
                            <td>{{ $did->tipo }}</td>
                            <td>{{ $did->prefijo }}</td>
                            <td>{{ $did->did }}</td>
                            <td>{{ $did->descripcion }}</td>
                            <td>{{ $did->Troncales->nombre }}</td>
                            <td>{{ $did->gateway }}</td>
                            <td>{{ $did->fakedid }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </fieldset>
</div>

<div class="col-12 viewCreate"></div>

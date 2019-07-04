<div class="col-12 viewIndex">
    <fieldset >
        <legend>
            <i class="fas fa-project-diagram"></i>
            Catalogo de Troncales
            <button type="button" class="btn btn-primary btn-xs newTroncal" style="float: right;margin-left: 5px;">
                <i class="fas fa-plus"></i>
                Nueva Troncal
            </button>
        </legend>
        <table id="tableTroncales" class="display table table-striped table-condensed" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>IP MEDIA</th>
                        <th>IP HOST</th>
                        <th>Distribuidor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($troncales as $troncal)
                        <tr data-id="{{ $troncal->id }}">
                            <td>{{ $troncal->nombre }}</td>
                            <td>{{ $troncal->ip_media }}</td>
                            <td>{{ $troncal->ip_host }}</td>
                            <td>{{ $troncal->Cat_Distribuidor->servicio }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </fieldset>
</div>

<div class="col-12 viewCreate"></div>

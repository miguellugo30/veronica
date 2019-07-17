<div class="col-12 viewIndex">
    <fieldset >
        <legend>
            <i class="fas fa-database"></i>
            Tipo Canal
            <button type="button" class="btn btn-primary btn-xs newTipoCanal" style="float: right;margin-left: 5px;">
                <i class="fas fa-plus"></i>
                Nuevo Tipo Canal
            </button>
        </legend>
        <table id="tableTiposCanal" class="display table table-striped table-condensed" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Prefjo</th>
                        <th>Distribuidor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tipocanales as $tipocanal)
                        <tr data-id="{{ $tipocanal->id }}">
                            <td>{{$tipocanal->nombre}}</td>
                            <td>{{$tipocanal->prefijo}}</td>
                            <td>{{$tipocanal->Cat_Distribuidor->servicio}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </fieldset>
</div>

<div class="col-12 viewCreate"></div>

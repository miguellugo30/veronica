<div class="col-12 viewIndex">
    <fieldset >
        <legend>
            <i class="far fa-hdd"></i>
            Catalogo NAS
            <button type="button" class="btn btn-primary btn-xs newNas" style="float: right;margin-left: 5px;">
                <i class="fas fa-plus"></i>
                Nueva NAS
            </button>
        </legend>
        <table id="tableNas" class="display table table-striped table-condensed" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>IP</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cat_nas as $nas)
                        <tr data-id="{{ $nas->id }}">
                            <td>{{ $nas->nombre }}</td>
                            <td>{{ $nas->ip_nas }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </fieldset>
</div>

<div class="col-12 viewCreate"></div>

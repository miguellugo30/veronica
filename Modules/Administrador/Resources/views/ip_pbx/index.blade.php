<div class="col-12 viewIndex">
    <fieldset >
        <legend>
            <i class="fas fa-server"></i>
            Catalogo PBX
            <button type="button" class="btn btn-primary btn-xs newPbx" style="float: right;margin-left: 5px;">
                <i class="fas fa-plus"></i>
                Nuevo PBX
            </button>
        </legend>
        <table id="tablePbx" class="display table table-striped table-condensed" style="width:100%">
            <thead>
                <tr>
                    <th>Media Server</th>
                    <th>IP</th>
                    <th>NAS</th>
                    <th>Base de Datos</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cat_ip_pbx as $ip_pbx)
                    <tr data-id="{{ $ip_pbx->id }}">
                        <td>{{ $ip_pbx->media_server }}</td>
                        <td>{{ $ip_pbx->ip_pbx }}</td>
                        <td>
                            @foreach ($ip_pbx->cat_nas as $v)
                                <label class="badge badge-success">{{ $v->nombre }} -- {{ $v->ip_nas }}</label><br>
                            @endforeach
                        </td>
                        <td>{{$ip_pbx->BaseDatos->nombre}}--{{ $ip_pbx->BaseDatos->ip }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </fieldset>
</div>

<div class="col-12 viewCreate"></div>

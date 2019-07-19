<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fas fa-phone"></i> PBX's</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary btn-xs newPbx" data-widget="remove"><i class="fas fa-plus"></i> Nuevo PBX</button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 viewIndex">
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
            </div>

            <div class="col-12 viewCreate"></div>
        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div>

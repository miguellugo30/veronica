<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><b><i class="far fa-hdd"></i> NAS</b></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary btn-sm newNas" data-widget="remove"><i class="fas fa-plus"></i> Nueva NAS</button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 viewIndex">
                <table id="tableNas" class="display table table-striped table-sm" style="width:100%">
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
            </div>

            <div class="col-12 viewCreate"></div>
        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div>

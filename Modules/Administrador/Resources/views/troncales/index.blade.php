<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fas fa-project-diagram"></i> Troncales</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary btn-sm newTroncal" data-widget="remove"><i class="fas fa-plus"></i> Nueva Troncal</button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 viewIndex">
                <table id="tableTroncales" class="display table table-striped table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>Distribuidor</th>
                            <th>Troncal</th>
                            <th>Descripci&oacute;n</th>
                            <th>IP MEDIA</th>
                            <th>IP HOST</th>
                            <th>Configuraci&oacute;n</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($troncales as $troncal)
                            <tr data-id="{{ $troncal->id }}">
                                <td>{{ $troncal->Cat_Distribuidor->servicio }}</td>
                                <td>{{ $troncal->nombre }}</td>
                                <td>{{ $troncal->descripcion }}</td>
                                <td>{{ $troncal->PBX->media_server." || ". $troncal->PBX->ip_pbx }}</td>
                                <td>{{ $troncal->ip_host }}</td>
                                <input type="hidden" name="id" id="id" value="{{ $troncal->id }}">
                                <td align="center">
                                    <button type="button" value="{{$troncal->id}}" class="btn bg-olive margin btn-sm show-modal" data-toggle="modal" data-target="#modal-info" style="margin: 0px;">
                                        <i class="fas fa-cog show-modal"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        <div id="configuracionmodal" class="modal fade">
                        </div>
                    </tbody>
                </table>
            </div>

            <div class="col-12 viewCreate"></div>
        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div>

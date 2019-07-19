<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fas fa-users"></i> Usuarios</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary btn-xs newUser" data-widget="remove"><i class="fas fa-plus"></i> Nuevo Usuario</button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 viewIndex">
                <table id="tableUsuarios" class="display table table-striped table-condensed" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Rol</th>
                            <th>Fecha alta</th>
                            <th>Fecha actualización</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $users as $user )
                            <tr data-id="{{ $user->id }}">
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if(!empty($user->getRoleNames()))
                                        @foreach($user->getRoleNames() as $v)
                                            <label class="badge badge-success">{{ $v }}</label>
                                        @endforeach
                                    @endif
                                </td>
                                <td>{{ date('d-m-Y H:i:s', strtotime($user->created_at)) }}</td>
                                <td>{{ date('d-m-Y H:i:s', strtotime($user->updated_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-12 viewCreate"></div>
        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div>


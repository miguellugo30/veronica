<div class="col-12 viewIndex">
    <fieldset>
        <legend>
            <i class="fas fa-users"></i> Usuarios
            <button type="button" class="btn btn-primary btn-xs newUser" style="float: right;">
                <i class="fas fa-user-plus"></i>
                Nuevo usuario
            </button>
        </legend>

        <div class="col-md-12">
            <table id="tableUsuarios" class="display table table-striped table-condensed" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Fecha alta</th>
                        <th>Fecha actualizacion</th>
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
    </fieldset>
</div>

<div class="col-12 viewCreate"></div>

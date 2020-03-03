<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fas fa-atlas"></i> Perfiles de Marcacion</h3>
        <div class="box-tools pull-right">
            <!--button type="button" class="btn btn-primary btn-xs nuevoPerfil" data-widget="remove"><i class="fas fa-plus"></i> Nuevo Perfil</button-->
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 viewIndex">
                <table id="tablePerfilMarcacion" class="display table table-bordered table-hover table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>Editar</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Prefijo Marcacion</th>
                            <th>Canal</th>
                            <th>Did</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach( $perfil_marcacion as $perfil )
                            <tr data-id="{{ dd($perfil)->fk_perfiles_id }}">
                                <td>{{ $perfil->nombre }}</td>
                                <td>{{$perfil->descripcion }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-12 viewCreate"></div>
        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div>

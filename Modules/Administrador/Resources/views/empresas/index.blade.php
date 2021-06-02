<div class="card  card-info card-outline showEmpresas">
    <div class="card-header ui-sortable-handle" >
        <h3 class="card-title">
            <i class="fas fa-building"></i>
            Empresas
        </h3>
        <div class="card-tools">
            @can('create empresas')
                <button type="button" class="btn btn-block bg-gradient-info btn-sm newEmpresa" data-widget="remove"><i class="fas fa-plus"></i> Nueva</button>
            @endcan
        </div>
    </div><!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col viewIndex table-responsive">
                <table id="tableEmpresas" class="display table table-bordered table-hover table-sm" >
                    <thead class="thead-light">
                        <tr>
                            <th>ID Cliente</th>
                            <!--th>Distribuidor</th-->
                            <th>Nombre</th>
                            <th>Ubicación</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empresas as $empresa)
                            <tr data-id="{{ $empresa->id }}" style="cursor:pointer">
                                <td>{{$empresa->id}}</td>
                                <!--td>{{-- $empresa->Config_Empresas->Distribuidores->servicio --}}</td-->
                                <td>{{$empresa->nombre}}</td>
                                <td>{{$empresa->nombre}}</td>
                                <td>
                                    <input type="hidden" id="dominio_empresa" value="http://info.App.mx">
                                    <button type="button" data-id_empresa="{{ $empresa->id }}" name="link" class="btn btn-info linkEmpresa"><i class="fas fa-sign-in-alt"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- /.row -->
    </div><!-- /.card-body -->
</div>
<!-- /.card -->


<div class="card viewCreate" style="display: none">
    <div class="card-header ui-sortable-handle" >
        <h3 class="card-title">
            <i class="fas fa-building"></i>
            Nueva Empresas
        </h3>
        <div class="card-tools">

        </div>
    </div><!-- /.card-header -->
    <div class="mt-4">
        <div class="col viewWizarEmpresa table-responsive mb-4">
        </div>
    </div><!-- /.card-body -->
</div>
<!-- /.card -->


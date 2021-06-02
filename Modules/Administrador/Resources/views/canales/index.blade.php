<div class="card  card-info card-outline showEmpresas">
    <div class="card-header ui-sortable-handle" >
        <h3 class="card-title">
            <i class="fas fa-project-diagram"></i> Canales
        </h3>
        <div class="card-tools">

        </div>
    </div><!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col viewIndex table-responsive">
                <table id="tableCanales" class="display table table-bordered table-hover table-sm" style="width:100%">
                    <thead class="thead-light">
                        <tr>
                            <th>Distribuidor</th>
                            <th>Empresa</th>
                            <th>Troncal</th>
                            <th>Tipo de Canal</th>
                            <th>Prefijo</th>
                        </tr>
                    </thead>
                    <!-- Iterar el arreglo $canales que contiene el resultado de consultar todos los registros que contiene la tabla de Canales
                    :: Nombre de Distribuidor
                    :: Nombre de Empresa
                    :: Troncal
                    :: Tipo de canal
                    :: Canal
                    -->
                    <tbody>
                        @foreach ($canales as $canal)
                            <tr data-id="{{ $canal->id }}">
                                <td>{{ $canal->Distribuidores->servicio }}</td>
                                <td>{{ $canal->Empresas->nombre }}</td>
                                <td>{{ ($canal->Troncales->nombre == "") ? "AMD" : $canal->Troncales->nombre }}</td>
                                <td>{{ $canal->Cat_Tipo_Canales->nombre }}</td>
                                <td>{{ $canal->prefijo }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- /.row -->
    </div><!-- /.card-body -->
</div>
<!-- /.card -->

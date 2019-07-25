<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><b><i class="fas fa-phone"></i> Estados de Agentes</b></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary btn-sm newEdoAge" data-widget="remove"><i class="fas fa-plus"></i> Nuevo catalogo</button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-md-12 viewIndex">
                <table id="tableEdoAge" class="display table table-striped table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Recibir Llamada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cat_agentes as $cat_agente)
                            <tr data-id="{{ $cat_agente->id }}">
                                <td>{{ $cat_agente->nombre }}</td>
                                <td>{{ $cat_agente->descripcion }}</td>
                                <td>
                                    @if ( $cat_agente->recibir_llamada == 'y' )
                                        {{ 'Si' }}
                                    @else
                                        {{ 'No' }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-12 viewCreate"></div>
        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div>

<div class="col-12 viewIndex">
    <fieldset >
        <legend>
            <i class="fas fa-th"></i>
            Catalogo Estado Agente
            <button type="button" class="btn btn-primary btn-xs newEdoAge" style="float: right;margin-left: 5px;">
                <i class="fas fa-plus"></i>
                Nuevo catalogo
            </button>
        </legend>
        <table id="tableEdoAge" class="display table table-striped table-condensed" style="width:100%">
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
    </fieldset>
</div>

<div class="col-12 viewCreate"></div>

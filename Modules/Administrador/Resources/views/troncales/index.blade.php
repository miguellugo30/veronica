<div class="col-12 viewIndex">
    <fieldset >
        <legend>
            <i class="fas fa-project-diagram"></i>
            Catalogo de Troncales
            <button type="button" class="btn btn-primary btn-xs newTroncal" style="float: right;margin-left: 5px;">
                <i class="fas fa-plus"></i>
                Nueva Troncal
            </button>
        </legend>
        <table id="tableTroncales" class="display table table-striped table-condensed" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Troncal Sansay</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($troncales as $troncale)
                        <tr data-id="{{ $troncale->id }}">
                            <td>{{ $troncale->nombre }}</td>
                            <td>{{ $troncale->troncal_sansay }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </fieldset>
</div>

<div class="col-12 viewCreate"></div>

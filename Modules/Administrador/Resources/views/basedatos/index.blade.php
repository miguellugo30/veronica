<div class="col-12 viewIndex">
    <fieldset >
        <legend>
            <i class="fas fa-database"></i>
            Base de Datos
            <button type="button" class="btn btn-primary btn-xs newDataBase" style="float: right;margin-left: 5px;">
                <i class="fas fa-plus"></i>
                Nueva Base de Datos
            </button>
        </legend>
        <table id="tableBaseDatos" class="display table table-striped table-condensed" style="width:100%">
                <thead>
                    <tr>
                        <th>Ubicación</th>
                        <th>Nombre</th>
                        <th>IP</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($basesDatos as $basesDato)
                        <tr data-id="{{ $basesDato->id }}">
                            <td>{{$basesDato->ubicacion}}</td>
                            <td>{{$basesDato->nombre}}</td>
                            <td>{{$basesDato->ip}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </fieldset>
</div>

<div class="col-12 viewCreate"></div>

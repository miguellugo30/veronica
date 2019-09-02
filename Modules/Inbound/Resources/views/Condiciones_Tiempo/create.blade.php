<form id="formDataCondicionTiempo">
    <div class="col-12" >
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="nombre"><b> Nombre Grupo</b></label>
                    <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Nombre Grupo">
                    @csrf
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <fieldset>
                <legend>Condiciones Tiempo</legend>
                <table id='condicion' class="table table-striped table-sm tableNewForm">
                    <thead>
                        <tr>
                            <th>Nombre condicion</th>
                            <th>Hora Inicio</th>
                            <th>Hora Fin</th>
                            <th>Dia Semana Inicio</th>
                            <th>Dia Semana Fin</th>
                            <th>Dia Mes Inicio</th>
                            <th>Dia Mes Fin</th>
                            <th>Mes Inicio</th>
                            <th>Mes Fin</th>

                            <td><input type="button" class="btn btn-primary btn-sm" id = "add" value = "Agregar campo" /></td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="tr_1" class="clonar">
                            <td>
                                <input type="text" class="form-control form-control-sm opciones" name="nombre_campo_1" id="nombre_campo" placeholder="Nombre Campo">
                            </td>
                            <td>
                                <input type="date" class="form-control form-control-sm opciones" name="hora_inicio_1" id="hora_inicio" placeholder="hora_inicio">
                            </td>
                            <td>
                                <input type="time" class="form-control form-control-sm opciones" name="hora_fin_1" id="hora_fin" placeholder="hora_fin">
                            </td>
                            <td>
                            <select name="dia_semana_inicio_1" id="dia_semana_inicio"  class="form-control form-control-sm opciones" placeholder="dia_demana_inicio" >
                                    <option value="*">-</option>
                                    @foreach ($dias as $dia)
                                    <option value="{{$dia['value']}}">{{ $dia['texto'] }}</option>
                                    @endforeach
                            </td>
                            <td>
                            <select name="dia_semana_fin_1" id="dia_semana_fin"  class="form-control form-control-sm opciones" placeholder="dia_semana_fin">
                                    <option value="*">-</option>
                                    @foreach ($dias as $dia)
                                    <option value="{{$dia['value']}}">{{ $dia['texto'] }}</option>
                                    @endforeach
                            </td>
                            <td>
                                <input type="number" min="01" max="31"  class="form-control form-control-sm opciones" name="dia_mes_inicio_1" id="dia_mes_inicio" placeholder="-">
                            </td>
                            <td>
                                <input type="number" min="01" max="31"  class="form-control form-control-sm opciones" name="dia_mes_inicio_1" id="dia_mes_inicio" placeholder="-">
                            </td>
                            <td>
                            <select name="mes_inicio_1" id="mes_inicio"  class="form-control form-control-sm opciones" placeholder="mes_inicio">
                                    <option value="*">-</option>
                                    @foreach ($meses as $mes)
                                    <option value="{{$mes['value']}}">{{ $mes['texto'] }}</option>
                                    @endforeach
                            </td>
                            <td>
                            <select name="mes_fin_1" id="mes_fin"  class="form-control form-control-sm opciones" placeholder="mes_fin">
                                    <option value="*">-</option>
                                    @foreach ($meses as $mes)
                                    <option value="{{$mes['value']}}">{{ $mes['texto'] }}</option>
                                    @endforeach
                            </td>

                            <td class="text-center">
                                <button type="button" name="view_1" id="view" class="btn btn-info view" style="display:none"><i class="fas fa-eye"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </fieldset>
        </div>
    </div>
</form>


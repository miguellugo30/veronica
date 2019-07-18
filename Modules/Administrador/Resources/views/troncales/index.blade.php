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
                        <th>Distribuidor</th>
                        <th>Troncal</th>
                        <th>IP MEDIA</th>
                        <th>IP HOST</th>
                        <th>Configuraci&oacute;n</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($troncales as $troncal)
                        <tr data-id="{{ $troncal->id }}">
                            <td>{{ $troncal->Cat_Distribuidor->servicio }}</td>
                            <td>{{ $troncal->nombre }}</td>
                            <td>{{ $troncal->ip_media }}</td>
                            <td>{{ $troncal->ip_host }}</td>        
                            <input type="hidden" name="id" id="id" value="{{ $troncal->id }}">                    
                            <td align="center">
                                <i class="fas fa-cog show-modal" value="{{$troncal->configuracion}}"></i>
                                <button type="button" value="{{$troncal->id}}" class="btn btn-info show-modal" data-toggle="modal" data-target="#modal-info">
                                    Launch Info Modal
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    <div id="configuracionmodal" class="modal fade">
                    </div>   
                </tbody>
            </table>
    </fieldset>
</div>

<div class="col-12 viewCreate"></div>

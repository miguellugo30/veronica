<table class="table table-striped table-sm" id="listadoAgentes">
    <thead class="thead-light text-center">
        <tr>
            <th scope="col">Grupo</th>
            <th scope="col">Tipo</th>
            <th scope="col">Estado</th>
            <th scope="col">Nombre</th>
            <th scope="col">Extensión</th>
            <th scope="col">Pantalla Agente</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach ($agentes as $agente)
            <tr id="agente_{{$agente->id}}">
                <td></td>
                <td>{{$agente->tipo_licencia}}</td>
                <td>
                    @if ( $agente->Cat_Estado_Agente_id == 1 )
                        <i class="fas fa-user-slash fa-lg text-secondary"></i>
                    @elseif( $agente->Cat_Estado_Agente_id == 2 )
                        <i class="fas fa-user-check fa-lg text-success"></i>
                    @elseif( $agente->Cat_Estado_Agente_id == 3 )
                        <i class="fas fa-user-clock fa-lg text-muted"></i>
                    @elseif( $agente->Cat_Estado_Agente_id == 4 || $agente->Cat_Estado_Agente_id == 8 )
                        <i class="fas fa-phone fa-lg text-info"></i>
                    @elseif( $agente->Cat_Estado_Agente_id == 11 )
                        <i class="fas fa-user-edit fa-lg text-warning"></i>
                    @elseif( $agente->Cat_Estado_Agente_id == 12 )
                        <i class="fas fa-user-edit fa-lg text-warning"></i>
                    @endif
                </td>
                <td>{{$agente->nombre}}</td>
                <td>{{$agente->extension}}</td>
                <td>
                    @if ( $agente->Cat_Estado_Agente_id != 1 )
                        @if ($agente->monitoreo == 0)
                            <button type="button" class="btn btn-primary btn-sm iniciar_monitoreo" data-id="{{$agente->id}}"><i class="far fa-eye"></i>  Iniciar</button>
                        @else
                            <button type="button" class="btn btn-danger btn-sm detener_monitoreo" data-id="{{$agente->id}}"><i class="far fa-eye-slash"></i> Detener</button>
                        @endif
                        <!--i class="fas fa-desktop fa-lg" data-id="{{--$agente->id--}}"></i-->
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

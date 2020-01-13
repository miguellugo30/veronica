<table class="table table-striped table-sm" id="listadoAgentes">
    <thead class="thead-light">
        <tr>
            <th scope="col"><input type="checkbox" name="" id=""></th>
            <th scope="col"></th>
            <th scope="col">Nombre</th>
            <th scope="col">Extensión</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($agentes as $agente)
            <tr id="agente_{{$agente->id}}">
                <td>
                    @if ( $agente->Cat_Estado_Agente_id == 1 )
                        <input type="checkbox" name="agente-check" class="agente-check" value="{{$agente->id}}" disabled>
                    @else
                        <input type="checkbox" name="agente-check" class="agente-check" value="{{$agente->id}}">
                    @endif
                </td>
                <td>
                    @if ( $agente->Cat_Estado_Agente_id == 1 )
                        <i class="fas fa-user-slash fa-lg"></i>
                    @elseif( $agente->Cat_Estado_Agente_id == 2 )
                        <i class="fas fa-user-check fa-lg"></i>
                    @elseif( $agente->Cat_Estado_Agente_id == 4 || $agente->Cat_Estado_Agente_id == 8 )
                        <i class="fas fa-phone fa-lg"></i>
                    @endif
                </td>
                <td>{{$agente->nombre}}</td>
                <td>{{$agente->extension}}</td>
            </tr>
        @endforeach
    </tbody>
</table>

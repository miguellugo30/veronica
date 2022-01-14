<div class="card card-outline card-primary">
    <div class="card-header">
        <h1 class="card-title"><b><i class="fas fa-chart-line"></i> Productividad por agentes</b></h1>
    </div><!--card-header-->
    <div class="card-body">
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-bordered table-striped table-sm align-middle">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th>Agente</th>
                            <th class="recibidas">Recibidas</th>
                            <th class="contestadas">Contestadas</th>
                            <th class="omitidas">Omitidas</th>
                            @foreach ($estados as $item => $value )
                                <th class="{{ \Str::kebab( \Str::lower( $item ) ) }}" colspan='2'>{{ $item }}</th>
                            @endforeach
                        </tr>
                        <tr class="text-center">
                            <th></th>
                            <th class="recibidas">#</th>
                            <th class="contestadas">#</th>
                            <th class="omitidas">#</th>
                            @foreach ($estados as $item => $value )
                                <!--th class="{{-- \Str::kebab( \Str::lower( $item ) ) --}}" >Eventos</th-->
                                <th class="{{ \Str::kebab( \Str::lower( $item ) ) }}" >Promedio</th>
                                <th class="{{ \Str::kebab( \Str::lower( $item ) ) }}" >Total</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < count( $data ); $i++)
                            @php
                                $info = $data[$i]['data'];
                                $estado = $data[$i]['estados'];
                            @endphp
                            <tr class="text-center">
                                <td>{{ $info['nombre'] }}</td>
                                <td class="recibidas">{{ $info['Recibidas'] }}</td>
                                <td class="contestadas">{{ $info['Contestadas'] }}</td>
                                <td class="omitidas">{{ $info['omitidas'] }}</td>
                                @foreach ($estados as $item => $value)
                                    @for ($j = 0; $j < count( $estado ); $j++)
                                        @php
                                            $bandera = 0;
                                        @endphp
                                        @if ( $value == $estado[$j]['Estadoid'] )
                                            @php
                                                $bandera = 1;
                                            @endphp
                                            @break
                                        @else
                                            @php
                                                $bandera = 0;
                                            @endphp
                                        @endif
                                    @endfor

                                    @if ( $bandera )
                                        <!--td class="{{-- \Str::kebab( \Str::lower( $item ) ) --}}" >{{-- $estado[$j]['Eventos'] --}}</td-->
                                        <td class="{{ \Str::kebab( \Str::lower( $item ) ) }}" >{{ $estado[$j]['Promedio'] }}</td>
                                        <td class="{{ \Str::kebab( \Str::lower( $item ) ) }}" >{{ $estado[$j]['Total'] }}</td>
                                    @else
                                        <!--td class="{{-- \Str::kebab( \Str::lower( $item ) ) --}}" >0</td-->
                                        <td class="{{ \Str::kebab( \Str::lower( $item ) ) }}" >00:00:00</td>
                                        <td class="{{ \Str::kebab( \Str::lower( $item ) ) }}" >00:00:00</td>
                                    @endif
                                @endforeach
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            <div class="col align-items-center">
                <div class="col" id="container_4"></div>
            </div>
        </div>
    </div><!--card-header-->
</div><!--card-->

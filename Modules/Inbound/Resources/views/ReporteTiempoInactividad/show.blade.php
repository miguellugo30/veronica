<div class="card card-outline card-primary">
    <div class="card-header">
        <h1 class="card-title"><b><i class="fas fa-chart-line"></i> Inactividad por agentes</b></h1>
    </div><!--card-header-->
    <div class="card-body">
        <div class="row">
            <div class="col table-responsive">
                <table class="table table-bordered table-striped table-sm align-middle">
                    <thead class="thead-light">
                        <tr class="text-center">
                            <th>Agente</th>
                            @foreach ($eventos as $item => $value )
                                <th class="{{ \Str::kebab( \Str::lower( $value->nombre ) ) }}" colspan='2'>{{ $value->nombre }}</th>
                            @endforeach
                        </tr>
                        <tr class="text-center">
                            <th></th>
                            @foreach ($eventos as $item => $value )
                                <th class="{{ \Str::kebab( \Str::lower( $value->nombre ) ) }}" >Promedio</th>
                                <th class="{{ \Str::kebab( \Str::lower( $value->nombre ) ) }}" >Total</th>
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
                                <td>{{ $info['usuario'] }}</td>
                                @foreach ($eventos as $item => $value)
                                    @for ($j = 0; $j < count( $estado ); $j++)
                                        @php
                                            $bandera = 0;
                                        @endphp
                                        @if ( $value->nombre == $estado[$j]['nombre'] )
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
                                        <td class="{{ \Str::kebab( \Str::lower( $item ) ) }}" >{{ $estado[$j]['Tiempo_estado_promedio'] }}</td>
                                        <td class="{{ \Str::kebab( \Str::lower( $item ) ) }}" >{{ $estado[$j]['Tiempo_estado_total'] }}</td>
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
        </div>
        <div class="col align-items-center">
            <div class="col" id="container_4" ></div>
        </div>
    </div><!--card-header-->
</div><!--card-->

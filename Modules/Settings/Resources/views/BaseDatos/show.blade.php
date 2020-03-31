@php
    set_time_limit(0);
    ini_set('memory_limit', -1);
@endphp
<table class="table table-bordered table-sm" id="registroBaseDatos">
    <thead>
        <tr class="table-active">
            <th>#</th>
            @for ($i = 0; $i < count( $campos ); $i++)
                <th>{{$campos[$i]}}</th>
            @endfor
        </tr>
    </thead>
    <tbody>
        @for ($i = 0; $i < count( $registros ); $i++)
            @php
                $data = (array)$registros[$i];
            @endphp
            <tr>
                <td>{{$i + 1 }}</td>
                @for ($j = 0; $j < count( $campos ); $j++)
                    <td>{{ $data[ $campos[$j] ] }}</td>
                @endfor
            </tr>
        @endfor
    </tbody>
</table>

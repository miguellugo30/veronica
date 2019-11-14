<h6><b>Inbound</b></h6>
<table class="table table-striped table-sm">
    <thead class="thead-light">
        <tr>
            <th>Campaña</th>
            <th>Num.</th>
            <th>Inicio</th>
            <th>Fin</th>
            <th>Ver</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($inbound as $in)
            <tr>
                <td>{{ $in->campana }}</td>
                <td>{{ $in->calledid }}</td>
                <td>{{ date( 'H:i:s', strtotime( $in->fecha_inicio ) ) }}</td>
                <td>{{  date( 'H:i:s', strtotime( $in->fecha_fin ) ) }}</td>
                <td><i class="far fa-plus-square text-primary"></i></td>
            </tr>
        @endforeach
    </tbody>
</table>
<hr>
<h6><b>Outbound</b></h6>
<table class="table table-striped table-sm">
    <thead class="thead-light">
        <tr>
            <th>Campaña</th>
            <th>Num.</th>
            <th>Inicio</th>
            <th>Fin</th>
            <th>Ver</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($outbound as $out)
            <tr>
                <td>{{ $out->campana }}</td>
                <td>{{ $out->calledid }}</td>
                <td>{{ date( 'H:i:s', strtotime( $out->fecha_inicio ) ) }}</td>
                <td>{{  date( 'H:i:s', strtotime( $out->fecha_fin ) ) }}</td>
                <td><i class="far fa-plus-square text-primary"></i></td>
            </tr>
        @endforeach
    </tbody>
</table>
<hr>
<h6><b>Manuales</b></h6>
<table class="table table-striped table-sm">
    <thead class="thead-light">
        <tr>
            <th>Campaña</th>
            <th>Num.</th>
            <th>Inicio</th>
            <th>Fin</th>
            <th>Ver</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($manual as $man)
            <tr>
                <td>{{ $man->campana }}</td>
                <td>{{ $man->calledid }}</td>
                <td>{{ date( 'H:i:s', strtotime( $man->fecha_inicio ) ) }}</td>
                <td>{{  date( 'H:i:s', strtotime( $man->fecha_fin ) ) }}</td>
                <td><i class="far fa-plus-square text-primary"></i></td>
            </tr>
        @endforeach
    </tbody>
</table>

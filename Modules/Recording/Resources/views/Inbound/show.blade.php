<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
<style>
        tfoot input {
            width: 100%;
            padding: 3px;
            box-sizing: border-box;
        }
        table.dataTable tr th.select-checkbox.selected::after {
        content: "✔";
        margin-top: -11px;
        margin-left: -4px;
        text-align: center;
        text-shadow: rgb(176, 190, 217) 1px 1px, rgb(176, 190, 217) -1px -1px, rgb(176, 190, 217) 1px -1px, rgb(176, 190, 217) -1px 1px;
        }
        </style>
<div align="center" id="botones">
        <!--<button type="button" class="btn-secondary btn-sm downloadGrabacion"  data-widget="remove"><i class="fas fa fa-download"></i> Descargar Grabaciones</button-->
        <!--button type="button" class="btn-secondary btn-sm deleteGrabacion"  data-widget="remove"><i class="fas fa-trash-alt"></i> Eliminar Grabaciones</button-->
</div>
<div class="box-tools pull-right">
    <!--button type="button" class="btn btn-primary btn-sm downloadGrabacion"  data-widget="remove"><i class="fas fa-plus"></i> Descargar Grabaciones</button-->
    <!--button type="button" class="btn btn-danger  btn-sm deleteGrabacion" ><i class="fas fa-trash-alt"></i> Eliminar Grabaciones</button-->
    <!--<button type="button" class="btn btn-primary btn-sm exportGrabacion" data-widget="remove"><i class="fas fa-file-excel-o"></i> Exportar a Excel</button>-->
    <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="">
</div>
<div class="box-tools">
        <img src="‪C:\Users\ivan.sanchez\Pictures\no-ftp.png"> La grabacion esta en el servidor de grabaciones<br>
        <img src="‪C:\Users\ivan.sanchez\Pictures\en-ftp.png"> La grabacion esta en el FTP del cliente
</div>

<table id="tableInbound" class="display table table-bordered table-hover table-sm" style="width:100%">
        <thead>
            <tr>
                <th><input type="checkbox" class="checkall" id="checkall"/></th>
                <th>FTP</th>
                <th>Campaña</th>
                <th>Agente</th>
                <th>Extension</th>
                <th>Numero</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Duracion</th>
                <th>Calificacion</th>
                <th>Subcalificacion</th>
                <th>Escuchar</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0;?>
            @foreach( $Grabaciones as $grabacion )
                <tr data-id="{{ $i+1 }}" style="cursor:pointer">
                    <td><?= $i+1; $i++; $i; ?> <input type="checkbox" value="<?=$i?>" class="numcheck_<?=$i?>"/></td>
                    <td>{{ $grabacion->estado }}</td>
                    <td>{{ $grabacion->campana }}</td>
                    <td>{{ $grabacion->agente }}</td>
                    <td>{{ $grabacion->extension }}</td>
                    <td>{{ $grabacion->numero }}</td>
                    <td>{{ $grabacion->inicio }}</td>
                    <td>{{ $grabacion->fin }}</td>
                    <td>{{ date('H:i:s',strtotime($grabacion->duracion)) }}</td>
                    <td></td>
                    <td></td>
                    <td><audio controls preload="metadata" controlsList="nodownload"><source src='{{ $grabacion->escuchar }}' type="audio/wav"></audio></td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th></th>
                <th>FTP</th>
                <th>Campaña</th>
                <th>Agente</th>
                <th>Extension</th>
                <th>Numero</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Duracion</th>
                <th>Calificacion</th>
                <th>Subcalificacion</th>
                <th>Escuchar</th>
            </tr>
        </tfoot>
    </table>


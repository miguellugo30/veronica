<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><b><i class="far fa-credit-card"></i> Licencias Bria</b></h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-primary btn-sm newLicencia" ><i class="fas fa-plus"></i> Nueva Licencia</button>
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-12 viewIndex">
                <table id="licencias_bria" class="display table table-striped table-sm" style="width:100%">
                    <thead>
                        <tr>
                            <th>Licencias</th>
                            <th>Ocupadas</th>
                            <th>Empresas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($licencias as $licencia)
                            <tr data-id="{{ $licencia->id }}" data-toggle="tooltip" data-placement="top" title="Doble click para editar" style="cursor:pointer">
                                <td>{{ $licencia->licencia }}</td>
                                <td>{{ $licencia->Extensiones->count() }}</td>
                                <td>
                                    {{$licencia->Extensiones->groupBy('Empresas_id');}}
                                    @if ( $licencia->Extensiones->count() != 0 )
                                        <button type="button" class="btn btn-lg btn-secondary btn-sm" data-toggle="popover" title="Empresas" data-content="
                                        <ul>
                                            @foreach ($licencia->Extensiones as $v)
                                                {{ "<li>".$v->Empresas->nombre.": </li>"}}
                                            @endforeach
                                        </ul>
                                        "> <i class="fas fa-eye"></i></button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-12 viewCreate"></div>
        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div>
<script>
$(function () {
  $('[data-toggle="popover"]').popover({
        html: true,
        trigger: "hover"
  })
})
</script>

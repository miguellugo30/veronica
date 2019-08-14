<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><b><i class="fas fa-align-justify"></i> Menús</b></h3>
        <div class="box-tools pull-right">
            @can('delete menus')
                <button type="button" class="btn btn-danger  btn-sm deleteMenu" style="display:none"><i class="fas fa-trash-alt"></i> Eliminar</button>
            @endcan
            @can('edit menus')
                <button type="button" class="btn btn-warning btn-sm editMenu" style="display:none"><i class="fas fa-edit"></i> Editar</button>
                <button type="button" class="btn btn-primary btn-sm orderignCat" data-widget="remove"><i class="fas fa-sort-numeric-down"></i> Ordenar</button>
            @endcan
            @can('create menus')
                <button type="button" class="btn btn-primary btn-sm newMenu" data-widget="remove"><i class="fas fa-plus"></i> Nuevo</button>
            @endcan
            <input type="hidden" name="idSeleccionado" id="idSeleccionado" value="">
            <input type="hidden" name="tipoSeleccionado" id="tipoSeleccionado" value="">
            <input type="hidden" name="ordenSeleccionado" id="ordenSeleccionado" value="0">
        </div>
    </div><!-- /.box-header -->
    <div class="box-body">
        <div class="row">
            <div class="col-12 viewIndex">
                <div class="col-md-12 viewTable">
                    <table id="tableMenus" class="display table table-sm table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Prioridad</th>
                                <th>tipo</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categorias as $categoria)
                                <tr data-id="{{ $categoria->id }}">
                                    <td class="details-control" data-id="{{ $categoria->id }}" style="text-align: center; cursor:pointer">
                                        <i class="fas fa-plus-circle mas"></i>
                                    </td>
                                    <td>{{ $categoria->nombre }}</td>
                                    <td>{{ $categoria->descripcion }}</td>
                                    <td>{{ $categoria->prioridad }}</td>
                                    <td>
                                        @if ($categoria->tipo == 1)
                                            Sistema
                                        @else
                                            Clientes
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6 viewSubCat" ></div>

            <div class="col-12 viewCreate"></div>
        </div><!-- /.row -->
    </div><!-- ./box-body -->
</div>
<!-- MODAL -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" id="modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <b><h5 class="modal-title" id="tituloModal">Modal title</h5></b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body">
                    ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary float-left" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                <button type="button" class="btn btn-sm btn-primary"  id="action"><i class="fas fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>
<!-- FIN MODAL -->
<script>
$(function() {

    let currentURL = window.location.href;

    table = $('.viewResult #tableMenus').DataTable({
                "lengthChange": true,
                "order": [
                    [3, "asc"]
                ]
            });

    $('#tableMenus tbody').on('click', 'td.details-control', function () {
        let tr = $(this).closest('tr');
        let row = table.row( tr );
        let id = $(this).data("id");
        /**
         * Si esta activo la tabla se oculta
         * De lo contrario, se muestra la tabla
         */
        if ( row.child.isShown() ) {

            $(".editMenu").slideUp();//Ocultamos el boton de editar
            $(".deleteMenu").slideUp();// Ocultamos el boton de eliminar
            $("#ordenSeleccionado").val(0);//Asignamos el valor del id, del elemento seleccionado

            $("#tableMenus tbody tr").removeClass('table-primary');//Quitamos la clase de seleccion

            $(this).find('i').removeClass('fa-minus-circle');///Quitamos la clase para mostrar el icono de menos
            $(this).find('i').addClass('fa-plus-circle');//Agregamos la clase para mostrar el icono de mas
            // This row is already open - close it
            row.child.hide();//Ocultamos la tabla
            tr.removeClass('shown');//Quitamos la clase

        } else {

            $(".editMenu").slideDown();//Mostramos el boton de editar
            $(".deleteMenu").slideDown();//Mostramos el boton de eliminar

            $("#idSeleccionado").val(id);//Asignamos el valor del id, del elemento seleccionado
            $("#tipoSeleccionado").val(1);//Asignamos el valor del id, del elemento seleccionado
            $("#ordenSeleccionado").val(1);//Asignamos el valor del id, del elemento seleccionado

            $("#tableMenus tbody tr").removeClass('table-primary');//Quitamos la clase de seleccion
            $(this).parent().addClass('table-primary')//Agregamos la clase de seleccion al tr

            $(this).find('i').removeClass('fa-plus-circle');//Quitamos la clase para mostrar el icono de mas
            $(this).find('i').addClass('fa-minus-circle');//Agregamos la clase para mostrar el icono de menos

            let url = currentURL + '/menus/' + id;
            $.get(url, function(data, textStatus, jqXHR) {
                row.child( data ).show();
            });
            // Open this row
            tr.addClass('shown');

        }
    });
});
</script>

<fieldset>
    <legend>
        <i class="fas fa-project-diagram"></i>
        Editar empresa: {{ $empresa->nombre }}
        <input type="hidden" name="id" id="id" value="{{ $empresa->id }}">
    </legend>
    <div class="col-md-12" style="float:none; margin:auto">
        <div class="col-md-2">
            <ul class="list-group menuEmpresa">
                <li data-opcion="dataGeneral" class="list-group-item active">Vista General</li>
                <li data-opcion="dataEmpresa" class="list-group-item">Informacion empresa</li>
                <li data-opcion="dataInfra" class="list-group-item">Informacion Infraestructura</li>
                <li data-opcion="dataModulo" class="list-group-item">Modulos</li>
                <li data-opcion="dataPosiciones" class="list-group-item">Posiciones en modulos</li>
                <li data-opcion="dataAlmacenamiento" class="list-group-item">Almacenamiento</li>
                <li data-opcion="dataCanales" class="list-group-item">Canales</li>
                <li data-opcion="dataExtensiones" class="list-group-item">Catalogo de extensiones</li>
                <li data-opcion="dataDids" class="list-group-item">Dids</li>
            </ul>
        </div>
        <div class="col-md-10 viewForm" >
            <form id="formDataEmpresa" method="post">

            </form>
        </div>
    </div>
    <div class="col-md-12">
        <!--div class="col-md-6" style="float:none; margin:auto"-->
            <div class="col-md-6" style="text-align:left">
                <button type="submit" class="btn btn-warning cancelEmpresa"><i class="fas fa-times"></i> Cancelar</button>
                <button type="submit" class="btn btn-danger deleteEmpresa"><i class="fas fa-trash-alt"></i> Eliminar</button>
            </div>
            <div class="col-md-6" style="text-align:right">
                <button type="submit" class="btn btn-primary updateEmpresa"><i class="fas fa-save"></i> Guardar</button>
            </div>
        <!--/div-->
    </div>
    <br>
    <br>
</fieldset>

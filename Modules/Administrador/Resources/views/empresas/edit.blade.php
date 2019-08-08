<div class="row" style="float:none; margin:auto">
    <div class="col-2">
        <ul class="list-group menuEmpresa" style="cursor:pointer">
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
        <br><br>
    </div>
    <div class="col-10 viewForm" >
        <input type="hidden" id="id" name="id" value="{{ $id }}">
        @csrf
        <form id="formDataEmpresa" method="post"></form>
        <br>
        <br>
        <br>
    </div>
</div>
<div class="row">
    <!--div class="col-md-6" style="float:none; margin:auto"-->
    <div class="col" style="text-align:left">
        <button type="submit" class="btn btn-primary btn-sm cancelEmpresa"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</button>
        <!--button type="submit" class="btn btn-danger deleteEmpresa"><i class="fas fa-trash-alt"></i> Eliminar</button-->
    </div>
    <div class="col" style="text-align:right">
        <button type="submit" class="btn btn-primary btn-sm" id="accionActualizar" style="display:none"><i class="fas fa-save"></i> Guardar</button>
    </div>
    <!--/div-->
</div>

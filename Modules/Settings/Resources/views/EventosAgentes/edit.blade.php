<div >
    <form enctype="multipart/form-data" id="formDataEventos" method="post">
        <div class="col">
            <fieldset>
            <div class="form-group">
                    <label for="nombre">Evento</label>
                    <input type="text" class="form-control form-control-sm" name="nombre" id="nombre"  value="{{$eventos->nombre}}">
                    <input type="hidden" name="id" id="id"  value="{{$eventos->id}}">
                    @csrf
                </div>
                <div class="form-group">
                    <label for="tiempo">Tiempo</label>
                    <input type="time" class="form-control form-control-sm" name="tiempo" id="tiempo"  value="{{$eventos->tiempo}}">
                </div>
                <!--div class="form-group">
                    <label for="tiempo">Fecha Inicio</label>
                    <input type="date" class="form-control form-control-sm" name="fechaini" id="fechaini"  value="" min="<?php echo date("Y-m-d");?>">
                </div>
                <div class="form-group">
                    <label for="tiempo">Fecha Fin</label>
                    <input type="date" class="form-control form-control-sm" name="fechafin" id="fechafin"  value="" min="<?php echo date("Y-m-d");?>">
                </div-->
            </fieldset>
        </div>
        <div class="col">

    </form>
</div>

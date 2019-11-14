<div >
    <form enctype="multipart/form-data" id="altaevento" method="post">
        <div class="col">
            <fieldset>
            <div class="form-group">
                    <label for="nombre">Evento</label>
                    <input type="text" class="form-control form-control-sm" name="nombre" id="nombre"  value="">

                    @csrf
                </div>
                <div class="form-group">
                    <label for="tiempo">Tiempo</label>
                    <input type="time" class="form-control form-control-sm" name="tiempo" id="tiempo"  value="<?php echo date("H:i");?>">
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

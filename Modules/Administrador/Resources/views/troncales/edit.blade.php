<fieldset>
    <legend>
        <i class="fas fa-project-diagram"></i>
        Editar Troncal
    </legend>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" placeholder="Nombre" value="{{ $troncal->nombre }}">
            <input type="hidden" name="id" id="id" value="{{ $id }}">
            @csrf
        </div>
        <div class="form-group">
            <label for="troncal_sansay">Troncal Sansay</label>
            <input type="text" class="form-control" id="troncal_sansay" placeholder="Troncal Sansay" value="{{ $troncal->troncal_sansay }}">
        </div>
    </div>
    <div class="col-md-6" style="float:none; margin:auto">
        <div class="col-md-6" style="text-align:left">
            <button type="submit" class="btn btn-warning cancelTroncal"><i class="fas fa-times"></i> Cancelar</button>
            <button type="submit" class="btn btn-danger deleteTroncal"><i class="fas fa-trash-alt"></i> Eliminar</button>
        </div>
        <div class="col-md-6" style="text-align:right">
            <button type="submit" class="btn btn-primary updateTrocal"><i class="fas fa-save"></i> Guardar</button>
        </div>
    </div>
    <br>
    <br>
</fieldset>

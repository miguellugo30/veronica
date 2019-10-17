<div class="col-12" >
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="calificaciones"><b>Calificacion</b></label>
                <select class="form-control form-control-sm" name="calificacion" id="calificacion">
                    <option value="">Selecciona una calificacion</option>
                    @foreach ($grupo->Calificaciones as $calificacion)
                        <option value="{{$calificacion->Formularios_id}}">{{$calificacion->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-12 viewFormularioCalificacion" >

    </div>
</div>

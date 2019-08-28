<!-- VISTA CALIFICACIONES -->
<form id="formDataCalificaciones">
    <div class="col-12" >
        <div class="row">
        
            <div class="col">
                <div class="form-group">
                    <label for="grupo"><b>Grupo Calificaci&oacute;n</b></label>
                    <!--Obtener Grupo-->
                    <select name="grupo" id="grupo" class="form-control form-control-sm">
                        <option value="">Seleccione un Grupo</option>
                        @foreach ($GrupoCalificacion as $grupo)
                            <option value="{{$grupo->id}}">{{ $grupo->nombre }}</option>
                        @endforeach                         
                    </select>                    
                </div>
            </div>
            
            <div class="col">             
                <div class="form-group">
                    <label for="tipo_id"><b>Tipo</b></label>
                    <select name="tipo_id" id="tipo_id" class="form-control form-control-sm">
                        <option value="">Seleccione un tipo</option>
                        @foreach ($TipoMarcacion as $tipo)
                            <option value="{{$tipo->id}}">{{ $tipo->tipo }}</option>
                        @endforeach
                    </select>
                </div>            
                <!--
                <div class="form-group">
                    <label for="nombre"><b> Tipo Marcaci&oacute;n</b></label>
                    <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Nombre Calificacion">
                    @csrf
                </div>
                -->
            </div>
            
            
        </div>
        
        <div class="col-md-12">
            <fieldset>
                <legend>Calificaciones</legend>
                <table id='calificaciones' class="table table-striped table-sm tableNewForm">
                    <thead>
                        <tr>
                            <th>Nombre Calificaci&oacute;n</th>   
                            <th>Formulario</th>
                            <th>SubCalificaci&oacute;n</th>
                            <td><input type="button" class="btn btn-primary btn-sm" id = "add" value = "Agregar" /></td>
                        </tr>
                    </thead>
                    
                    
                    <tbody>
                    
                        <tr id="tr_1" class="clonar">
                            <td>
                                <input type="text" class="form-control form-control-sm opciones" name="nombre_campo_1" id="nombre_campo" placeholder="Nombre Calificacion">
                            </td>
                                    
                                                        
                            <div class="form-group selectTipoInbound" style="display:none" >
                               <td>
                                <select name="tipo_formulario_1" id="tipo_formulario" data-action="create" class="form-control form-control-sm ">
                                  <option value="">Selecciona un formulario</option>
                                     @foreach( $formularios as $formulario )
                                      <option value="{{ $formulario->id }}">{{ $formulario->nombre }}</option>
                                     @endforeach
                                </select>
                               </td>       
                            </div>
                            
                            <div class="form-group selectTipoOutbound" style="display:none" >
                               <td>
                                <select name="tipo_formulario_2" id="tipo_formulario" data-action="create" class="form-control form-control-sm ">
                                  <option value="">Selecciona un formulario</option>
                                     @foreach( $formularios as $formulario )
                                      <option value="{{ $formulario->id }}">{{ $formulario->nombre }}</option>
                                     @endforeach
                                </select>
                               </td>       
                            </div>
                            
                            
                            
   <div class="form-group selectModulo"  style="display:none">
        <label for="modulo_id"><b>Modulo</b></label>
        <select name="modulo_id" id="modulo_id" class="form-control form-control-sm">
            <option value="">Selecciona un modulo</option>
            
        </select>
    </div>

                            
                            
                            
                            
                            
                            <td>
                                <input type="checkbox" class="micheckbox opciones" name="editable_1" id="editable">
                                <input type="hidden" name="editable_hidden_1" id="editable_hidden" value="off" class="opciones">
                                <input type="hidden" name="opciones_1" id="opciones" class="opciones " value="">
                            </td>
                            
                            <td class="tr_clone_remove text-center">
                                <button type="button" name="remove" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                            </td>
                            
                            <td class="text-center">
                                <button type="button" name="view_1" id="view" class="btn btn-info view" style="display:none"><i class="fas fa-eye"></i></button>
                            </td>
                            
                        </tr>
                        
                    </tbody>
                    
                    
                </table>
            </fieldset>
        </div>
    </div>
</form>


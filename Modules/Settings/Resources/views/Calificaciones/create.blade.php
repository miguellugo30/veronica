<!-- VISTA CALIFICACIONES -->
<!-- Este es elemento que se cambia -->
<form id="formDataCalificaciones">
    <div class="col-12" >
        <div class="row">
        
            <div class="col">
                <div class="form-group">
                    <label for="nombre_grupo"><b> Nombre Grupo</b></label>
                    <input type="text" class="form-control form-control-sm" id="nombre_grupo" name="nombre_grupo" placeholder="Nombre Grupo Calificacion">
                    @csrf
                </div>
            </div>
           
            <!--Tipos Marcacion-->
            <div class="col">             
                <div class="form-group">
                    <label for="tipo_marcacion"><b>Tipo Marcaci&oacute;n</b></label>
                    <select name="tipo_marcacion" id="tipo_marcacion" class="form-control form-control-sm">   
                        <option value="">Seleccione un tipo</option>                        
                            <option value="Inbound">Inbound</option> 
                            <option value="Outbound">Outbound</option> 
                            <option value="Manuales">Manuales</option>                        
                    </select>
                </div> 
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
                                <input type="text" class="form-control form-control-sm opciones" name="nombre_calificacion_1" id="nombre_calificacion" placeholder="Nombre Calificacion">
                                @csrf

                            </td>
                                    
                            <td>                            
                              <!--div class="form-group selectModulo" style="display:none" -->
                              <div class="form-group selectModulo">                                    
                                <select name="tipo_formulario_1" id="tipo_formulario" data-action="create" class="form-control form-control-sm ">
                                  <option value="">Selecciona un formulario</option>
                                    @foreach( $formularios as $formulario )
                                       <option value="{{ $formulario->id }}">{{ $formulario->nombre }}</option>
                                    @endforeach
                                </select>                                                        
                              </div>
                            </td>                            
       
       
       
       
                            <td>
                                <input type="checkbox" class="micheckbox opciones" name="editable_1" id="editable">
                                <input type="hidden" name="editable_hidden_1" id="editable_hidden" value="off" class="opciones">
                                <input type="hidden" name="opciones_1" id="opciones" class="opciones " value="">
                            </td>
                            
                            <!---Btn Eliminar-->
                            <td class="tr_clone_remove text-center">
                                <button type="button" name="remove" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                            </td>
                            
                            <!-- Boton para ver detalle [aun no lo uso]-->                            
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


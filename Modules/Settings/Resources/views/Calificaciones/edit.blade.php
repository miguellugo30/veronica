<!-- EDICION CALIFICACIONES -->
<!-- Este es elemento que se cambia -->
<form id="formDataCalificaciones">
    <div class="col-12" >
        <div class="row">      
                   
           <div class="col">
                <div class="form-group">
                    <label for="nombre_grupo"><b> Nombre Grupo</b></label>
                    <input type="text" class="form-control form-control-sm" id="nombre_grupo" name="nombre_grupo" placeholder="Nombre Grupo Calificacion" 
                    value='{{$grupos->nombre}}' disabled >
                    <input type="hidden" name="id_grupo" id="id_grupo" value="{{$grupos->id}}">
                </div>
            </div>
            
                     
           <!--Tipos Marcacion-->
           <div class="col">
                <div class="form-group">
                    <label for="tipo_marcacion"><b>Tipo Marcaci&oacute;n</b></label>
                    <select name="tipo_marcacion" id="tipo_marcacion" class="form-control form-control-sm">
                        <option value="">Seleccione un tipo</option>
                        @foreach ($TipoMarcacion as $tipo)
                            <option value="{{$tipo->id}}" {{($tipo->id == $id_cat_tipo_marcacion->Cat_Tipo_Marcacion_id) ? 'selected = "selected"':'' }}>{{ $tipo->tipo }}</option>
                        @endforeach    
                            
                    </select>
                </div>
            </div>
             
        </div>
        
        
        <div class="col-md-12">
            <fieldset>
                <legend>Calificaciones</legend>
                <table id='calificaciones' class="table table-striped table-sm tableNewForm">
                    <!-- Cabeceras -->
                    <thead>
                        <tr>
                            <th>Nombre Calificaci&oacute;n</th>   
                            <th>Formulario</th>
                            <th>SubCalificaci&oacute;n</th>
                            <td><input type="button" class="btn btn-primary btn-sm" id = "add_c" value = "Agregar" /></td>
                        </tr>
                    </thead>
                    <!-- Cabeceras -->
                    
                    
                    <tbody>
                        @foreach ($calificaciones as $calificacion) 
                        <!-- Cabeceros -->
                        <tr id="tr_1" class="clonar"> 
                            <td>
                                <input type="hidden" name="id_calificacion_{{$calificaciones->id }}" class="opciones" id="id_calificacion" value="{{$calificaciones->id }}">
                                <input type="text" class="form-control form-control-sm opciones" name="nombre_calificacion_{{$calificaciones->id }}" id="nombre_calificacion" 
                                      value='{{$calificaciones->nombre }}'>
                            </td>   
                                                                                       
                            <td>                            
                              <!--div class="form-group selectModulo" style="display:none" -->
                              <!-- En tipo en referencia al elemento no el objeto -->
                              <div class="form-group selectModulo">                                    
                                <select name="tipo_formulario_1" id="tipo_formulario" data-action="create" class="form-control form-control-sm ">
                                  <option value="">Selecciona un formulario</option>                                  
                                  @foreach( $formularios as $formulario )
                                     <option value="{{ $formulario->id }}" {{($formulario->id == $calificaciones->Formularios_id ) ? 'selected = "selected"':'' }}>{{ $formulario->nombre }}</option>
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
                       @endforeach

                    </tbody>
                    
                    
                </table>
            </fieldset>
        </div>
        
        
    </div>
</form>

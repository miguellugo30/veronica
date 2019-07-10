<fieldset>
    <legend>
        <i class="fas fa-project-diagram"></i>
        Editar empresa: {{ $empresa->nombre }}
    </legend>
    <div class="col-md-12" style="float:none; margin:auto">
        <div class="col-md-2">
            <ul class="list-group">
                <li href="#" class="list-group-item active">Informacion empresa</li>
                <li href="#" class="list-group-item">Informacion Infraestructura</li>
                <li href="#" class="list-group-item">Modulos</li>
                <li href="#" class="list-group-item">Posiciones en modulos</li>
                <li href="#" class="list-group-item">Catalogo de extensiones</li>
            </ul>
        </div>
        <div class="col-md-10 viewForm" >
            <form id="formDataEmpresa" method="post">
                <div class="form-group">
                    <label for="distribuidores_empresa">Distribuidor</label>
                    <select name="distribuidores_empresa" id="distribuidores_empresa" class="form-control input-sm">
                        <option value="" >Selecciona un distribuidor</option>
                        @foreach( $distribuidores as $distribuidor )
                            <option value="{{ $distribuidor->id }}" >{{ $distribuidor->servicio }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control input-sm" id="nombre" name="nombre" placeholder="Nombre" value="{{ $empresa->nombre }}">
                    <input type="hidden" name="id" id="id" value="{{ $empresa->id }}">
                    <input type="hidden" name="action" id="action" value="dataEmpresa">
                    @csrf
                </div>
                <div class="form-group">
                    <label for="contacto_cliente">Contacto Cliente</label>
                    <input type="text" class="form-control input-sm" id="contacto_cliente" name="contacto_cliente" placeholder="Contacto Cliente" value="{{ $empresa->contacto_cliente }}">
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección</label>
                    <input type="text" class="form-control input-sm" id="direccion" name="direccion" placeholder="Direccion" value="{{ $empresa->direccion }}">
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ciudad">Cuidad</label>
                        <input type="text" class="form-control input-sm" id="ciudad" name="ciudad" placeholder="Cuidad" value="{{ $empresa->ciudad }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <input type="text" class="form-control input-sm" id="estado" name="estado" placeholder="Estado" value="{{ $empresa->estado }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="pais">País</label>
                    <input type="text" class="form-control input-sm" id="pais" name="pais" placeholder="Pais" value="{{ $empresa->pais }}">
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control input-sm" id="telefono" name="telefono" placeholder="Telefono" value="{{ $empresa->telefono }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="movil">Teléfono Móvil</label>
                        <input type="text" class="form-control input-sm" id="movil" name="movil" placeholder="Telefono Movil" value="{{ $empresa->movil }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="correo">Correo Electrónico</label>
                    <input type="text" class="form-control input-sm" id="correo" name="correo" placeholder="Correo Electronico" value="{{ $empresa->correo }}">
                </div>
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


<style>
    .hora{
        background-color: white;
        display: inline-flex;
        border: 1px solid #ccc;
        color: #555;
    }
    .hora input{
        border: none;
        color: #555;
        text-align: center;
        width: 50px;
        height: 29px;
    }
    </style>
    <form id="formDataEnrutamiento">
        <div class="col-12" >
            <fieldset>
                <legend>
                    <input type="button" class="btn btn-primary btn-sm" id = "add" value = "Agregar Ruta" style="float: right;" />
                </legend>
                <table id='condicion' class="table table-striped table-sm tableNewForm">
                    <thead>
                        <tr>
                            <th>Descripcion</th>
                            <th>Destino</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($enrutamiento as $item)
                        <tr id="tr_1" class="clonar">
                                <td>
                                    <input type="text" class="form-control form-control-sm" name="descripcion_campo_1" id="descripcion_campo" placeholder="Descripcion" value="{{ $item->aplicacion }}">
                                </td>
                                <td>
                                    <select name="destino_1" id="destino"  class="form-control form-control-sm destino">
                                        <option value="">Selecciona una opción</option>
                                        <option value="Audios_Empresa" {{ $item->tabla == "Audios_Empresa"? 'selected = "selected"' : '' }} >Anuncio</option>
                                        <option value="Aplicacion" {{ $item->tabla == "Aplicacion"? 'selected = "selected"' : '' }} >Aplicación</option>
                                        <option value="Campanas" {{ $item->tabla == "Campanas"? 'selected = "selected"' : '' }} >Campaña</option>
                                        <option value="hangup"{{ $item->tabla == "hangup"? 'selected = "selected"' : '' }}>Colgar llamada</option>
                                        <option value="Condiciones_Tiempo"{{ $item->tabla == "Condiciones_Tiempo"? 'selected = "selected"' : '' }}>Condición de Tiempo</option>
                                        <option value="Conferencia"{{ $item->tabla == "Conferencia"? 'selected = "selected"' : '' }}>Conferencia</option>
                                        <option value="Desvios"{{ $item->tabla == "Desvios"? 'selected = "selected"' : '' }}>Desvio</option>
                                        <option value="Cat_Extensiones"{{ $item->tabla == "Cat_Extensiones"? 'selected = "selected"' : '' }}>Extensión</option>
                                        <option value="Ivr"{{ $item->tabla == "Ivr"? 'selected = "selected"' : '' }}>IVR</option>
                                    </select>
                                </td>
                                <td>
                                    <div class="opcionesDestino_1"></div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </fieldset>
        </div>
    </form>

<h5><b>Modulos</b></h5>
<hr>
<div class="row">
    <div class="col">
        @foreach( $modulos as $modulo )
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="cats[]" value="{{ $modulo->id }}">
                    {{ $modulo->nombre }}
                </label>
            </div>
            <div class="col" >
                @foreach ($modulo->categorias as $categoria)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="cats[]" value="{{ $categoria->id }}">
                            {{ $categoria->nombre }}
                        </label>
                    </div>
                    <div class="col" >
                        @foreach ($categoria->Sub_Categorias as $sub)
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="cats[]" value="{{ $sub->id }}">
                                    {{ $sub->nombre }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>

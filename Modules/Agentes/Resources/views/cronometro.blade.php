<div class="row">
    <div class="col-12 text-center">
        <i class=" text-info fas fa-user-clock fa-7x"></i>
    </div>
    <div class="col-12 text-center">
        <br>
        <h1><b id="tiempo-no-disponible">00:00:00</b></h1>
    </div>
    <input type="hidden" name="agente_evento" id="agente_evento" value="{{$agente}}">
    <input type="hidden" name="id_no_disponible" id="id_no_disponible" value="{{$evento->id}}">
</div>

<script>
    $(function() {

        pantalla = document.getElementById("tiempo-no-disponible");
        var isMarch = false;
        var acumularTime = 0;

        if (isMarch == false) {
            timeInicial = new Date();
            control = setInterval(cronometro,10);
            isMarch = true;
        }

        function cronometro () {
            timeActual = new Date();
            acumularTime = timeActual - timeInicial;
            acumularTime2 = new Date();
            acumularTime2.setTime(acumularTime);
            cc = Math.round(acumularTime2.getMilliseconds()/10);
            ss = acumularTime2.getSeconds();
            mm = acumularTime2.getMinutes();
            hh = acumularTime2.getHours()-18;
            if (ss < 10) {ss = "0"+ss;}
            if (mm < 10) {mm = "0"+mm;}
            if (hh < 10) {hh = "0"+hh;}
            pantalla.innerHTML = hh+" : "+mm+" : "+ss;
        }

    });
</script>

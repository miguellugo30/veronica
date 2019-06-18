$(function() {

    var currentURL = window.location.href;
    /**
     * Evento para mostrar el formulario de crear un nuevo distribuidores
     */
    $(document).on("click", ".nuevoDid", function(e) {
        e.preventDefault();
        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();

        let url = currentURL + '/did/create';

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);
        });
    }); 
      
              
      /**
      * Evento para guardar el nuevo did
      */
            $(document).on('click', '.saveDid', function(event) {
                event.preventDefault();


                let id_empresa = $("#id_empresa").val();
                let tipo = $("#tipo").val();
                let prefijo = $("#prefijo").val();
                let did = $("#did").val();
                let descripcion = $("#descripcion").val();
                let id_troncal_sansay = $("#id_troncal_sansay").val();
                let gateway = $("#gateway").val();
                let fakedid = $("#fakedid").val();
                
                
                let _token = $("input[name=_token]").val();
                let url = currentURL + '/did';
                let arr = $('[name="cats[]"]:checked').map(function() {
                    return this.value;
                }).get();

                $.post(url, {
                    id_empresa: id_empresa,
                    tipo: tipo,
                    prefijo: prefijo,
                    did: did,
                    descripcion: descripcion,
                    
                    id_troncal_sansay: id_troncal_sansay,
                    gateway: gateway,
                    fakedid: fakedid,
                    
                    arr: arr,
                    _token: _token
                }, function(data, textStatus, xhr) {
                    $('.viewResult').html(data);
                    $('.viewCreate').slideUp();
                    $('.viewIndex').slideDown();
                    $('.viewResult #tableDids').DataTable({
                        "lengthChange": true
                    });
                });

            });
    
    
    
    
    
    
    /**
     * Evento para mostrar el formulario editar distribuidores
     */
    $(document).on('dblclick', '#tableDid tbody tr', function(event) {
        event.preventDefault();

        $(".viewIndex").slideUp();
        $(".viewCreate").slideDown();

        let id = $(this).data("id");
        let url = currentURL + "/did/" + id + "/edit";
        
       // alert(url);

        $.get(url, function(data, textStatus, jqXHR) {
            $(".viewCreate").html(data);

        });
    });
    /**
     * Evento para cancelar la creacion/edicion del distribuidores
     */
    $(document).on("click", ".cancelDid", function(e) {
        $(".viewIndex").slideDown();
        $(".viewCreate").slideUp();
        $(".viewCreate").html('');
    });
    /**
     * Evento para editar el distribuidores
     */
    $(document).on('click', '.updateDid', function(event) {
        event.preventDefault();
        // formdata es para down de IL
              
        let id_empresa = $("#id_empresa").val();        
        let id_did = $("#id_did").val();
        let tipo = $("#tipo").val();
        let prefijo = $("#prefijo").val();
        let did = $("#did").val();
        let descripcion = $("#descripcion").val();
        let id_troncal_sansay = $("#id_troncal_sansay").val();
        let gateway = $("#gateway").val();
        let fakedid = $("#fakedid").val();
        let _token = $("input[name=_token]").val();
        let _method = 'PUT';
        let url = currentURL + '/did/' + id_did;
       
        $.ajax({
            url: url,
            type: 'POST',
            data: {
               id_empresa: id_empresa,
               id_did: id_did,
               tipo: tipo,
               prefijo: prefijo,
               did: did,
               descripcion: descripcion,                    
               id_troncal_sansay: id_troncal_sansay,
               gateway: gateway,
               fakedid: fakedid,
                _token: _token,
                _method: _method
            },
            success: function(result) {
                $('.viewResult').html(result);
                $('.viewCreate').slideUp();
                $('.viewIndex').slideDown();
                $('.viewResult #tableDid').DataTable({
                    "lengthChange": true,
                    "order": [
                        [2, "asc"]
                    ]
                });
            }
        });
        
        
        
       
    });
    /**
     * Evento para eliminar el did
     * 
     */
    $(document).on('click', '.deleteDid', function(event) {
        event.preventDefault();

        let id_did = $("#id_did").val();
        let _token = $("input[name=_token]").val();
        let url = currentURL + '/did/' + id_did;

        $.ajax({
            url: url,
            type: 'DELETE',
            data: {
                _token: _token
            },
            success: function(result) {
                $('.viewResult').html(result);
                $('.viewIndex #tableDid').DataTable({
                    "lengthChange": true,
                    "order": [
                        [2, "asc"]
                    ]
                });
            }
        });
    });
});
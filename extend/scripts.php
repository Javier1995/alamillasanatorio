</main>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/print.min.js"></script>
<script type="text/javascript" src="../js/materialize.js"></script>
<script type="text/javascript" src="../js/materialize.min.js"></script>
<script type="text/javascript" src="../js/sweetalert.min.js"></script>
<script type="text/javascript"  src="../js/buscador.js"></script>
<script type="text/javascript"  src="../js/jquery-confirm.min.js"></script>
<script>

    $("#icon-cerrar").on("click", function () {
        $("#errores").modal('close');
    });
    //Oculta los alerts
    $("#alert_box_success").hide();
    $("#alert_box_warning").hide();
    $("#alert_box_error").hide();

    //Cierrar las cajas 
    $('#alert_close_success').click(function () {
        $("#alert_box_success").fadeOut("slow");
    });

    $('#alert_close_error').click(function () {
        $("#alert_box_error").fadeOut("slow");
    });

    $('#alert_close_warning').click(function () {
        $("#alert_box_warning").fadeOut("slow");
    });



    $('.dropdown-button').dropdown({
        inDuration: 300,
        outDuration: 225,
        constrainWidth: false, // Does not change width of dropdown to that of the activator
        hover: false, // Activate on hover
        gutter: 0, // Spacing from edge
        belowOrigin: true, // Displays dropdown below the button
        alignment: 'right', // Displays dropdown with edge aligned to the left of button
        stopPropagation: false // Stops event propagation
    }
    );
    $(".number").on({
        "focus": function (event) {
            $(event.target).select();
        },
        "keyup": function (event) {
            $(event.target).val(function (index, value) {
                return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
            });
        }
    });
    $(document).ready(function () {
        $('.collapsible').collapsible();
    });

    $('.button-collapse').sideNav();
    $('.modal').modal();
    $('select').material_select();
    function may(obj, id) {

        obj = obj.toUpperCase();
        document.getElementById(id).value = obj;
    }
    function NumCheck(e, field) {
        key = e.keyCode ? e.keyCode : e.which
// backspace
        if (key == 8)
            return true
// 0-9
        if (key > 47 && key < 58) {
            if (field.value == "")
                return true
            regexp = /.[0-9]{9}$/
            return !(regexp.test(field.value))
        }
// .
        if (key == 46) {
            if (field.value == "")
                return false
            regexp = /^[0-9]+$/
            return regexp.test(field.value)
        }
// other key
        return false

    }


//Cambio de contraseña

    function cargar_cambio_contrasena(id, nick) {
        var url = "vista_modal_cambio_contrasena.php";
        $.ajax({
            method: "POST",
            url: url,
            data: {id: id, nick: nick},
            success: (data) => {
                $("#resultado_cambio").html(data);
            }
        });

    }

    //cerrar el modal
    $('#cerrar_modal2').click(function () {
        $('#modal2').modal('close');
    });
    $('#cerrar_modal1').click(function () {
        $('#modal1').modal('close');
    });

    /* Inicio de la busqueda */
    $('#buscar').click(function () {
        $.post('buscar_medicamento.php', {
            barcode: $('#codigo_barras').val(),
            beforeSend: function () {
                $('#busqueda').html("<div class=\"preloader-wrapper small active\"><div class=\"spinner-layer spinner-green-only\"><div class=\"circle-clipper left\"><div class=\"circle\"></div></div><div class=\"gap-patch\"><div class=\"circle\"></div></div><div class=\"circle-clipper right\"><div class=\"circle\"></div></div></div></div>");
            }
        }, function (respuesta) {
            $('#busqueda').html(respuesta);
        });

    });
    /* Fin de la busqueda */







        
        //Bloque todo el teclado excepto los numeros y retorno de carro(8)
        function validar(e) {
            tecla = (document.all) ? e.keyCode : e.which;
            if (tecla == 8)
                return true;
            if (tecla == 48)
                return true;
            if (tecla == 49)
                return true;
            if (tecla == 50)
                return true;
            if (tecla == 51)
                return true;
            if (tecla == 52)
                return true;
            if (tecla == 53)
                return true;
            if (tecla == 54)
                return true;
            if (tecla == 55)
                return true;
            if (tecla == 56)
                return true;
            if (tecla == 57)
                return true;
            patron = /1/; //ver nota
            te = String.fromCharCode(tecla);
            return patron.test(te);
        }


    $(document).ready(function () {
        $('#codigo_barras_b').keypress(function validar(e) {
            tecla = (document.all) ? e.keyCode : e.which;
            if (tecla == 8)
                return true;
            if (tecla == 48)
                return true;
            if (tecla == 49)
                return true;
            if (tecla == 50)
                return true;
            if (tecla == 51)
                return true;
            if (tecla == 52)
                return true;
            if (tecla == 53)
                return true;
            if (tecla == 54)
                return true;
            if (tecla == 55)
                return true;
            if (tecla == 56)
                return true;
            if (tecla == 57)
                return true;
            if (tecla == 13)
                return false;
            if (tecla == 32)
                return false;
            patron = /1/; //ver nota
            te = String.fromCharCode(tecla);
            return patron.test(te);
        });
        $("#codigo_barras_b").focus();
//CACHA DE DATOS DEL CODIGO DE BARRA
        $("#codigo_barras_b").on("keyup", function (e) {
            e.preventDefault();

            var barcode = document.getElementById("codigo_barras_b").value;

            if (barcode.length == 13) {
                var url = "ajax_compra.php";
                $.ajax({
                    type: "POST",
                    url: url,
                    beforesend: "Cargando...",
                    error: "Problemas en el servidor",
                    timeout: 4000,
                    data: {barcode: barcode},
                    success: function (datos) {
                        $('#resultado2').html(datos);
                    }
                });
                $("#codigo_barras_b").val("");
            }
        });

    });

    $('#nueva_compra').on('click', function () {
        var url = "folio.php";
        $.ajax({
            type: "POST",
            url: url,
            success: function (datos) {

            }
        });
    });









    /*======================================
     FIN FUNCIONES PARA LA VENTA
     ========================================*/

    /*===================================
     Inicio de Busqueda de medicamento
     =====================================*/
//Vista de buscar medicamento
    $("#buscarMedi").click(function () {
        $('#etiquetaCompra').hide();
        $('#resultado').load('busquedaMedi/searchingMed.view.php');
    });

    /*BUSQUEDA DE MEDICAMENTO*/
    $("#busMed").on('keypress', function () {
        var url = "busquedaMedi/busqueda_med.php";
        var campo = $("#busMed").val();
        $('#respuestaBusqueda').html("<div class=\"progress\"><div class=\"indeterminate\"></div></div>");

        $.ajax({
            type: "post",
            url: url,
            data: {campo: campo},
            success: function (data) {
                $("#respuestaBusqueda").html(data);
            }

        });

    });
    /*===================================
     Fin de Busqueda de medicamento
     =====================================*/



    /*==================================================
     FUNCIONES DE INVENTARIO
     ====================================================*/
//Inventario entrada
    $('#entrada').click(function () {
        var url = "view/entrada.php";
        $('#invetario').hide();
        $('#resultadoInv').load(url);
    });


    /*Buscar inventario entrada*/
    $('#buscarEn').click(function () {
        var url = "view_result/entradaBuscar.php";
        var fecha_in = document.getElementById("fecha_in").value
        var fecha_fin = document.getElementById("fecha_fin").value
        $.ajax({
            type: "POST",
            url: url,
            data: {fecha_in: fecha_in, fecha_fin: fecha_fin},
            success: function (datos) {
                $("#resultadoEn").html(datos);

            }
        })
    });

    /*PDF ENTRADA*/
    $('#buscarpdf').click(function () {
        var url = "ajax_procesador/procesarEntrada.php";
        var fecha_in = document.getElementById("fecha_in").value
        var fecha_fin = document.getElementById("fecha_fin").value
        $.ajax({
            type: "POST",
            url: url,
            data: {fecha_in: fecha_in, fecha_fin: fecha_fin},
            success: function (datos) {
                $("#pdf").html(datos);

            }
        })
    });


//FIN INVETARIO ENTRADA

    /*EXISTENCIA*/
    $('#existencia').click(function () {
        var url = "view/existencia.php";
        $('#invetario').hide();
        $('#resultadoInv').load(url);
    });


    $('#existe').click(function () {
        var url = "view_result/existenciaBuscar.php";
        var data = $("#existen").val();
        $.ajax({
            type: "POST",
            url: url,
            data: {dato: data},
            success: function (datos) {
                $("#resultadoEx").html(datos);
            }
        })
    });

    /*PDF EXISTENCIA*/
    $('#existenciapdf').click(function () {
        var url = "ajax_procesador/procesarExistencia.php";
        var data = $("#existen").val();
        $.ajax({
            type: "POST",
            url: url,
            data: {dato: data},
            success: function (datos) {
                $("#resultadoEx").html(datos);
            }
        })
    });


    /*PDF DE CADUCIDAD*/
    $("#caducidad").on('click', () => {
//let url = 'pdf_con_fpdf/caducidad.php'
//window.print(url);
    });


    /**FIN PDF DE CADUCIDAD*/
    /*==================================================f
     FIN DE FUNCIONES DE INVENTARIOO
     ====================================================*/
</script>

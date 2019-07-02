
//Guarda Medicamentos
$("#submit").on("click", function (e) {
    e.preventDefault();
    const respuesta = document.getElementById("respuesta");
    var barcode2 = document.getElementById("barcode").value,
            nombregenerico = document.getElementById("nombregenerico").value,
            nombrecomercial = document.getElementById("nombrecomercial").value,
            categoria = document.getElementById("categoria").value,
            precioa = document.getElementById("precioa").value,
            preciov = document.getElementById("preciov").value,
            presentacion = document.getElementById("presentacion").value,
            unidades = document.getElementById("unidades").value,
            stockmin = document.getElementById("stockmin").value,
            descripcion = document.getElementById("descripcion").value,
            lote = document.getElementById("lote").value,
            caducidad = document.getElementById("caducidad").value,
            piezas = document.getElementById("piezas").value;
    $.ajax({
        url: "guardar_producto.php",
        type: "POST",
        async: true,
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        data: {
            barcode2: barcode2,
            nombregenerico: nombregenerico,
            nombrecomercial: nombrecomercial,
            categoria: categoria,
            precioa: precioa,
            preciov: preciov,
            presentacion: presentacion,
            unidades: unidades,
            stockmin: stockmin,
            descripcion: descripcion,
            lote: lote,
            caducidad: caducidad,
            piezas: piezas
        },
        beforeSend: function () {
            respuesta.innerHTML = "<p>Guardando...</p>";
        },
        error: function () {
            alert("error en el servidor");
        },
        success: function (data) {

            console.log(data);
            var errores = JSON.parse(data);
            var showError = "";
            if (errores.length != 0) {
                showError = '<ol>';

                for (var i = 0; i < errores.length; i++) {

                    showError += "<li>" + errores[i] + "</li>";

                }

                showError += '</ol>';

                document.getElementById("m-error").innerHTML = showError;
                respuesta.innerHTML = '';
                $("#errores").modal('open');


            } else {

                document.getElementById("barcode").value = "";
                document.getElementById("nombregenerico").value = "";
                document.getElementById("nombrecomercial").value = "";
                document.getElementById("categoria").value = "0";
                document.getElementById("precioa").value = "";
                document.getElementById("preciov").value = "";
                document.getElementById("presentacion").value = "";
                document.getElementById("unidades").value = "";
                document.getElementById("stockmin").value = "";
                document.getElementById("descripcion").value = "";
                document.getElementById("lote").value = "";
                document.getElementById("piezas").value = "";
                document.getElementById("caducidad").value = "";
                respuesta.innerHTML = "";
                swal("Bien", "Se ha guardado correctamente", "success").then(() => {
                    document.getElementById("barcode").autofocus;
                });
            }

        }

    });
    return true;
});


//Editar medicamento

$("#submit_edit").on("click", function (e) {
    e.preventDefault();
    const respuesta = document.getElementById("respuesta");
    var barcode2 = document.getElementById("barcode").value,
            nombregenerico = document.getElementById("nombregenerico").value,
            nombrecomercial = document.getElementById("nombrecomercial").value,
            categoria = document.getElementById("categoria").value,
            precioa = document.getElementById("precioa").value,
            preciov = document.getElementById("preciov").value,
            presentacion = document.getElementById("presentacion").value,
            unidades = document.getElementById("unidades").value,
            stockmin = document.getElementById("stockmin").value,
            descripcion = document.getElementById("descripcion").value;
    $.ajax({
        url: "guardar_edit_producto.php",
        type: "POST",
        async: true,
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        data: {
            barcode2: barcode2,
            nombregenerico: nombregenerico,
            nombrecomercial: nombrecomercial,
            categoria: categoria,
            precioa: precioa,
            preciov: preciov,
            presentacion: presentacion,
            unidades: unidades,
            stockmin: stockmin,
            descripcion: descripcion
        },
        beforeSend: function () {
            respuesta.innerHTML = "<p>Guardando...</p>";
        },
        error: function () {
            alert("error en el servidor");
        },
        success: function (data) {

            console.log(data);
            var errores = JSON.parse(data);
            var showError = "";
            if (errores.length != 0) {
                showError = '<ol>';

                for (var i = 0; i < errores.length; i++) {

                    showError += "<li>" + errores[i] + "</li>";

                }

                showError += '</ol>';

                document.getElementById("m-error").innerHTML = showError;
                respuesta.innerHTML = '';
                $("#errores").modal('open');


            } else {

                respuesta.innerHTML = "";
                swal("Bien", "Se ha guardado correctamente", "success").then(() => {
                    location.href = "./";
                });
                ;

            }

        }

    });

});

//Guardar lote
$("#codigo").on("keyup", function (e) {
    e.preventDefault();
    const respuesta = document.getElementById("respuesta");
    var barcode2 = document.getElementById("codigo").value;
    if(barcode2.length === 13){
    $.ajax({
        url: "buscar_medicamento.php",
        type: "POST",
        async: true,
        data: {
            barcode2: barcode2
        },
        beforeSend: function () {
            respuesta.innerHTML = "<p>Cargando...</p>";
            barcode2 = '';
        },
        error: function () {
            alert("error en el servidor");
        },
        success: function (data) {

            console.log(data);
            var datos = JSON.parse(data);
            var muestra = "";
            if (datos.length == 1) {
                showError = '<ol>';

                for (var i = 0; i < datos.length; i++) {

                    muestra += "<li>" + datos[i] + "</li>";

                }

                muestra += '</ol>';

                document.getElementById("m-error").innerHTML = muestra;
                respuesta.innerHTML = '';
                $("#errores").modal('open');
                document.getElementById("codigo").value = '';

            } else {
                document.getElementById("codigo").value = '';
                muestra = '<div class="row"><table class="bordered striped centered highlight responsive-table">';

                muestra += '<thead><tr><th>Codigo</th><th>Nombre Comercial</th><th>Precio Salida</th><th>Stock</th><th>Lote</th><th>Caducidad</th><th>Cantidad</th></tr></thead><tbody>';

                muestra += '<tr><td>' + datos.cve_medicamento + '</td><td>' + datos.nombre_comercial + '</td><td>$' + datos.precio_venta + '</td><td>'+datos.stock+'</td><td><input type="text" id="lote" onkeyup="may(this.value, this.id)"/></td><td><input type="text" class="datepicker" id="caducidad"></td><td><input type="text" id="cantidad" onkeyup="this.value=Numeros(this.value)"/></td><td><button class="btn" id="agregar" onclick="lote_guardar(' + datos.cve_medicamento + ')"/>Agregar</button></td></tr></tbody>';
                muestra += '</table></div>';
                respuesta.innerHTML = muestra;
                
                var date = new Date();
                var today = '12/31/' + date.getFullYear();
                
                //Datepicker para fechas
                 $('.datepicker').pickadate({
                   //Traduccion del formato
                   default: 'now',
                   format:'yyyy-mm-dd',
                   today:'HOY',
                   clear:'LIMPIAR',
                   close:'CERRAR',
                   selectMonths: true, // Creates a dropdown to control month
                   selectYears: 40,
                   min: today,
                   //Traducción de Meses, semanas y dias
                   monthsFull:['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ],
                   monthsShort:['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic' ],
                   weekdaysFull:['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado' ],
                   weekdaysShort:['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab' ],
                   weekdaysLetter:['D', 'L', 'M', 'X', 'J', 'V', 'S' ]
                 });

                 

            }

        }

    });
    }
});


function Numeros(string) { //Solo numeros
    var out = '';
    var filtro = '1234567890'; //Caracteres validos

    //Recorrer el texto y verificar si el caracter se encuentra en la lista de validos 
    for (var i = 0; i < string.length; i++)
        if (filtro.indexOf(string.charAt(i)) != -1)
            //Se añaden a la salida los caracteres validos
            out += string.charAt(i);

    //Retornar valor filtrado
    return out;
}

$("#icon-cerrar").on("click", function () {
    $("#errores").modal('close');
});


function lote_guardar(codigo) {

    var lote = $("#lote").val(),
            cantidad = $("#cantidad").val(),
            caducidad = $("#caducidad").val();
    $.ajax({
        url: "guardar_lote_medicamento.php",
        type: "POST",
        async: true,
        data: {
            barcode: codigo,
            lote: lote,
            piezas: cantidad,
            caducidad: caducidad
        },
        error: function () {
            alert("error en el servidor");
        },
        success: function (data) {

            console.log(data);
            var datos = JSON.parse(data);
            var muestra = "";
            if (datos.length != 0) {
                showError = '<ol>';

                for (var i = 0; i < datos.length; i++) {

                    muestra += "<li>" + datos[i] + "</li>";

                }

                muestra += '</ol>';

                document.getElementById("m-error").innerHTML = muestra;
                $("#errores").modal('open');


            } else {

                $("#respuesta table").fadeOut("clip");
                swal("Bien", "Se ha guardado correctamente", "success");
            }

        }

    });

}



function modificar_lote(lote_antiguo, codigo) {

    var lote = $("#lote").val(),
            cantidad = $("#cantidad").val(),
            caducidad = $("#caducidad").val();

    $.ajax({
        url: "editar_lote_medicamento.php",
        type: "POST",
        async: true,
        data: {
            barcode: codigo,
            lote: lote,
            piezas: cantidad,
            caducidad: caducidad,
            lote_antiguo: lote_antiguo
        },
        error: function () {
            alert("error en el servidor");
        },
        success: function (data) {

            console.log(data);
            var datos = JSON.parse(data);
            var muestra = "";
            if (datos.length != 0) {
                showError = '<ol>';

                for (var i = 0; i < datos.length; i++) {

                    muestra += "<li>" + datos[i] + "</li>";

                }

                muestra += '</ol>';

                document.getElementById("m-error").innerHTML = muestra;
                $("#errores").modal('open');


            } else {

                $("#respuesta table").fadeOut("clip");
                swal("Bien", "Se ha actualizado correctamente", "success").then(() => {
                    location.href = 'entradas.php';
                });
            }

        }

    });

}



function borrar_medicamento(codigo) {
    var barcode = codigo;
    swal({
        title: "¿Estas seguro de borrar el medicamento?",
        text: "Esto podia alterar la estadisticas",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        catch: {value: barcode}
    }).then((willDelete, value) => {
           console.log(barcode);
        if (willDelete) {
            $.ajax({//Inicio de del ajax
                url: "borrar_medicamento.php",
                type: "POST",
                data: {
                    barcode: barcode
                },
                error: function () {
                    alert("error en el servidor");
                },
                success: function(data) {
                    console.log(data);
                    var datos = JSON.parse(data);
                    
                    var muestra = "";
                    if (datos.length >= 1) {
                        showError = '<ol>';

                        for (var i = 0; i < datos.length; i++) {

                            muestra += "<li>" + datos[i] + "</li>";

                        }

                        muestra += '</ol>';

                        document.getElementById("m-error").innerHTML = muestra;
                        $("#errores").modal('open');


                    } else {
                        $("#" + codigo).fadeOut("slow", () => {
                            swal("Bien", "Se ha borrado correctamente", "success");
                        });
                    }



                }

            });//Inicio del AJAX
        }

    });

}


function borrar_lote(lote) {
    alert(lote);
    swal({
        title: "¿Estas seguro de borrar el medicamento?",
        text: "Esto podia alterar la estadisticas",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        catch: {value: lote}
    }).then((willDelete, value) => {
        console.log(value);
        if (willDelete) {
            $.ajax({//Inicio de del ajax
                url: "borrar_lote.php",
                type: "POST",
                data: {
                    lote: lote
                },
                error: function () {
                    alert("error en el servidor");
                },
                success: function(data) {
                    
                      $("#" +lote).fadeOut("slow", () => {
                            swal("Bien", "Se ha borrado correctamente", "success");
                        });




                }

            });//Inicio del AJAX
        }

    });

}


var date = new Date();
     var today = '12/31/' + date.getFullYear();
     
     //Datepicker para fechas
      $('.datepicker').pickadate({
        //Traduccion del formato
        default: 'now',
        format:'yyyy-mm-dd',
        today:'HOY',
        clear:'LIMPIAR',
        close:'CERRAR',
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 140,
        min: today,
        //Traducción de Meses, semanas y dias
        monthsFull:['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ],
        monthsShort:['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic' ],
        weekdaysFull:['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado' ],
        weekdaysShort:['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab' ],
        weekdaysLetter:['D', 'L', 'M', 'X', 'J', 'V', 'S' ],
      });
      

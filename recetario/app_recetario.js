


$("#busca-paciente").on("click", function (event) {
    event.preventDefault();
    const respuesta = document.getElementById("tabla-pacientes");
    var paciente = document.getElementById("paciente").value;
    $.ajax({
        url: "busqueda_paciente.php",
        type: "POST",
        data: {
            paciente: paciente

        },
        beforeSend: function () {
            respuesta.innerHTML = '<div class="progress"><div class="indeterminate"></div></div>';
        },
        error: function () {
            alert("error en el servidor");
        },
        success: function (data) {


            var pacientes = JSON.parse(data);
            if (pacientes.length != 0) {

                showTable = '<table class="striped animated lightSpeedIn fast">';
                showTable += '<thead>';
                showTable += '<tr>';
                showTable += '<th>';
                showTable += 'Nombre del paciente';
                showTable += '</th>';
                showTable += '<th>';
                showTable += 'Fecha nacimiento';
                showTable += '</th>';
                showTable += '<th>';
                showTable += 'Edad';
                showTable += '</th>';
                showTable += '<tr>';
                showTable += '</thead>';


                showTable += '<tbody>';

                for (var i = 0; i < pacientes.length; i++) {
                    showTable += '<tr id="'+pacientes[i].id+'">';

                    showTable += '<td>';
                    showTable += '<a href="paciente?paciente=' + pacientes[i].id + '">' + pacientes[i].nombre_completo + '</a>';
                    showTable += '</td>';
                    showTable += "<td>" + pacientes[i].fecha_nacimiento + "</td>";
                    showTable += '<td>' + pacientes[i].edad + ' Años</td>';
                    showTable += '<td>';

                    showTable += '<a href="#" class="btn-floating grey lighten-2 dropdown-button" href="#" data-activates="pa' + pacientes[i].id + '">';
                    showTable += '<i class="material-icons black-text">more_vert</i></a>';
                    showTable += '<ul id="pa' + pacientes[i].id + '" class="dropdown-content">';
                    showTable += '<li><a class="left-align" href="edit_paciente.php?edit='+pacientes[i].id+'">Editar datos</a></li>';
                    showTable += '<li><a class="left-align" href="#" onclick="borrar_paciente(' + pacientes[i].id + ')">Borrar</a></li>';
                    showTable += '</ul>';

                    showTable += '</td>';

                    showTable += '</tr>';

                }
                showTable += '</tbody>';
                showTable += '</table>';
                respuesta.innerHTML = showTable;

                $('.dropdown-button').dropdown({
                    inDuration: 300,
                    outDuration: 225,
                    constrain_width: true,
                    hover: false,
                    alignment: 'left',
                    gutter: 0,
                    belowOrigin: false
                }
                );



            } else {

                respuesta.innerHTML = "<h5>No se encontraron resultados.  <a href='nuevo'> Click aquí </a>  para registrar un nuevo paciente<h5>";

            }

        }


    });

});




function guardar_paciente(e) {
    e.preventDefault();
    const respuesta = document.getElementById("respuesta");
    var nombre = document.getElementById("nombre").value,
            apellidos = document.getElementById("apellidos").value,
            nacimiento = document.getElementById("nacimiento").value;
    $.ajax({
        url: "guardar_paciente.php",
        type: "POST",
        async: true,
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        data: {
            nombre: nombre,
            apellidos: apellidos,
            nacimiento: nacimiento
        },
        beforeSend: function () {
            respuesta.innerHTML = '<div class="progress"><div class="indeterminate"></div></div>';
        },
        error: function () {
            alert("error en el servidor");
        },
        success: function (data) {
            var errores = JSON.parse(data);
            var showError = "";
            if (errores.errores.length !== 0) {
                showError = '<ol>';

                for (var i = 0; i < errores.errores.length; i++) {

                    showError += "<li>" + errores.errores[i] + "</li>";

                }

                showError += '</ol>';

                document.getElementById("m-error").innerHTML = showError;
                respuesta.innerHTML = '';
                $("#errores").modal('open');


            } else {

                nombre = document.getElementById("nombre").value = '';
                apellidos = document.getElementById("apellidos").value = '';
                nacimiento = document.getElementById("nacimiento").value = '';
                respuesta.innerHTML = "";
                swal("Bien", "Se ha guardado correctamente", "success").then(() => {
                    location.href = "paciente?paciente="+errores.id[0]+"";
                });
            }

        }

    });
    return true;
}


function guardar_receta_medica(id, e) {
    e.preventDefault();
    console.log(id);
    
    const respuesta = document.getElementById("resultado_receta");
    const carga = document.getElementById("carga");
    var dato = '';
    var diagnostico = document.getElementById("diagnosticoNuevo").value;
    var medicamento = document.getElementById("medicamentoNuevo").value;
    $.ajax({
        url: "guardar_consulta.php",
        type: "POST",
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        data: {
            id:id,
            medicamento:medicamento,
            diagnostico:diagnostico

        },
        beforeSend:function() {
            carga.innerHTML = '<div class="progress"><div class="indeterminate"></div></div>';
        },
        error: function () {
            alert("error en el servidor");
        },
        success: function (data) {
            console.log(data);
            var errores = JSON.parse(data);
            var showError = "";
            
            if (errores.errores.length !== 0) {
                showError = '<ol>';

                for (var i = 0; i < errores.errores.length; i++) {

                    showError += "<li>" + errores.errores[i] + "</li>";

                }

                showError += '</ol>';
                document.getElementById("m-error").innerHTML = showError;
                $("#errores").modal('open');
                carga.innerHTML = '';

            } else {
                dato+="<h5>La receta ha sido guardada<h5> <button class=\"btn\" onclick=\"printJS({printable:'recetario/pdf/recetario.php?re="+errores.id[0]+"', type:'pdf', showModal:true})\"><i class=\"material-icons left\">print</i>Imprimir</button>";
                dato+="<a href=\"./\" class=\"btn red\"><i class=\"material-icons left\">arrow_back</i> Regregar</a>";
                respuesta.innerHTML = dato;
                carga.innerHTML = '';
            }

        }


    });

}







function edit_paciente(e, id) {
    e.preventDefault();
    const respuesta = document.getElementById("respuesta");
    var nombre = document.getElementById("nombre").value,
        apellidos = document.getElementById("apellidos").value,
        nacimiento = document.getElementById("nacimiento").value;
    $.ajax({
        url: "actualizar_paciente.php",
        type: "POST",
        async: true,
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        data: {
            nombre: nombre,
            apellidos: apellidos,
            nacimiento: nacimiento,
            id: id
        },
        beforeSend: function () {
            respuesta.innerHTML = '<div class="progress"><div class="indeterminate"></div></div>';
        },
        error: function () {
            alert("error en el servidor");
        },
        success: function (data) {
            console.log(data);
            var errores = JSON.parse(data);
            var showError = "";
            if (errores.length !== 0) {
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
                swal("Bien", "Se ha actualizado correctamente", "success");
            }

        }

    });
    return true;
}


function borrar_paciente(id){
    
     swal({
        title: "¿Estas seguro de borrar el paciente?",
        text: "Una vez borrado ya no podra visualizarlo",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        catch: {value: id}
    }).then((willDelete, value) => {
           console.log(id);
        if (willDelete) {
            $.ajax({//Inicio de del ajax
                url: "borrar_paciente.php",
                type: "POST",
                data: {
                    id:id
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
                        $("#"+id).fadeOut("slow", () => {
                            swal("Bien", "Se ha borrado correctamente", "success");
                        });
                    }



                }

            });//Inicio del AJAX
        }

    });
    
}
//Contador de caracteres
 $(document).ready(function() {
    $('input#input_text, textarea#textarea1').characterCounter();
  });


function editar_receta_medica(folio, e) {
    e.preventDefault();
    console.log(folio);
    const respuesta = document.getElementById("resultado_receta");
    const carga = document.getElementById("carga");
    var dato = '';
    var diagnostico = document.getElementById("diagnosticoNuevo").value;
    var medicamento = document.getElementById("medicamentoNuevo").value;
    $.ajax({
        url: "editar_consulta.php",
        type: "POST",
        contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
        data: {
            folio:folio,
            medicamento:medicamento,
            diagnostico:diagnostico

        },
        beforeSend:function() {
            carga.innerHTML = '<div class="progress"><div class="indeterminate"></div></div>';
        },
        error: function () {
            alert("error en el servidor");
        },
        success: function (data) {
            console.log(data);
            var errores = JSON.parse(data);
            var showError = "";
            
            if (errores.errores.length !== 0) {
                showError = '<ol>';

                for (var i = 0; i < errores.errores.length; i++) {

                    showError += "<li>" + errores.errores[i] + "</li>";

                }

                showError += '</ol>';
                document.getElementById("m-error").innerHTML = showError;
                $("#errores").modal('open');
                carga.innerHTML = '';

            } else {
                dato+="<h5>La receta ha sido editada <a href='pdf/recetario.php?re="+errores.id[0]+"' target=\"_blank\">click aquí</a> para generarla<h5>";
                dato+="<a href=\"./\" class=\"btn red\"><i class=\"material-icons left\">arrow_back</i> Regregar</a>";
                respuesta.innerHTML = dato;
                carga.innerHTML = '';
            }

        }


    });

}

var fecha = new Date();
var today = '12/31/' + fecha.getFullYear();

//Datepicker para fechas
$('.datepicker').pickadate({
    default: 'now',
    format: 'yyyy-mm-dd',
    today: 'HOY',
    clear: 'LIMPIAR',
    close: 'CERRAR',
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 120,
    max: today,
    //Traducción de Meses, semanas y dias
    monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
    weekdaysLetter: ['D', 'L', 'M', 'X', 'J', 'V', 'S'],
});
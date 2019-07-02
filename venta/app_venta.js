/* 
 * FUNCIONES PARA EJECUCION DE LAS VENTAS
 */
var lista_pedidos = $('#lista_pedidos');
lista_pedidos.on("load", PaginationOrder());

function listar_venta(e, code_data = null, descuento = null) {
    e.preventDefault();
    var codigo = $("#code");
    var progressbar = '<div class="progress"><div class="determinate" style="width: 70%"></div></div>';
    var carga = $("#cargando");
    if (codigo.val().length === 13 || descuento !== null) {
        $.ajax({
            url: "ajax/procesador.venta.php",
            type: "POST",
            data: {codigo: codigo.val(), codigo_desc: code_data, descuento: descuento},
            error: function (dato) {
                document.write(dato.responseText);
                alert("No se puede procesar. Error en el servidor");
                carga.html("");
            },
            success: function (dato) {
                var tablRow = '';
                var error = '';
                var warning = '';
                var success = '';
                var sumSubtotal = 0;
                var descuento = 0;
                var total = 0;
                var caja = '';
                const formatter = new Intl.NumberFormat('en-US', {
                    style: 'currency',
                    currency: 'USD',
                    minimumFractionDigits: 2
                })



                if (dato.warning !== null && dato.warning !== undefined) {
                    Materialize.toast(dato.warning, 7000, 'yellow darken-3');
                }


                if (dato.error !== null && dato.error !== undefined) {
                    var $content = $('<span>' + dato.error + '</span>').add($('<a href="../alta/agregar_productos?code=' + codigo.val() + '" class="btn-flat toast-action">Dar Alta</a>'));
                    Materialize.toast(dato.error, 7000, 'red');
                }

                if (dato.success !== null && dato.success !== undefined) {
                    Materialize.toast(dato.success, 7000, 'card green darken-1 z-depth-4');
                }


                if (dato.cart.length !== undefined && dato.cart.length !== 0) {
                    for (var i = 0; i < dato.cart.length; i++) {

                        tablRow += "<tr>" +
                                "<td>" + (i + 1) + "</td>"
                                + "<td>" + dato.cart[i].cve_medicamento + "</td>"
                                + "<td>" + dato.cart[i].nombre_generico + "</td>"
                                + "<td>" + dato.cart[i].nombre_comercial + "</td>"
                                + "<td>" + dato.cart[i].presentacion + "</td>"
                                + "<td>" + formatter.format(dato.cart[i].precio) + "</td>"
                                + "<td>" + dato.cart[i].unidad + "</td>"
                                + "<td>" + formatter.format((dato.cart[i].unidad * dato.cart[i].precio) - (dato.cart[i].unidad * dato.cart[i].precio) * (dato.cart[i].descuento / 100)) + "</td>"
                                + "<td><input id=\"descuento\" type=\"text\" onblur=\"listar_venta(event,'" + dato.cart[i].cve_medicamento + "', this.value)\" value='" + dato.cart[i].descuento + "' max=\"100\" min=\"0\"/></td>"
                                + "<td><button class=\"btn-floating red\" onclick=\"borrar_item(" + dato.cart[i].cve_medicamento + ",1)\"><i class=\"material-icons\">cancel</i></button></td>"
                                + "</tr>";
                        sumSubtotal += ((dato.cart[i].unidad * dato.cart[i].precio));
                        descuento += (dato.cart[i].unidad * dato.cart[i].precio) * (dato.cart[i].descuento / 100);
                        total += ((dato.cart[i].unidad * dato.cart[i].precio)) - (dato.cart[i].unidad * dato.cart[i].precio) * (dato.cart[i].descuento / 100);
                        ;
                       
                    }
                      console.log(descuento+' ddd');

                    if (dato.cart.length === 0) {
                        caja += '<div class="input-field col s6 l6">'
                                + '<input type="text"  id="money" placeholder="Efectivo.." disabled>'
                                + '</div>'
                                + '<div class="input-field col s3 l3">'
                                + '<button type="submit" class="btn"><i class="material-icons" disabled>'
                                + 'attach_money'
                                + '</i></button>'
                                + '</div>'
                                + '<div class="input-field col s3 l3 ">'
                                + '<button onclick="borrar_compra()" class="btn red"><i class="material-icons" disabled>'
                                + 'cancel'
                                + '</i></button>'
                                + '</div>';
                    } else {
                        caja += '<div class="input-field col s6 l6">'
                                + '<input type="text" id="money" placeholder="Efectivo..">'
                                + '</div>'
                                + '<div class="input-field col s3 l3">'
                                + '<button type="submit" class="btn"><i class="material-icons">'
                                + 'attach_money'
                                + '</i></button>'
                                + '</div>'
                                + '<div class="input-field col s3 l3 ">'
                                + '<button onclick="borrar_compra()" class="btn red"><i class="material-icons">'
                                + 'cancel'
                                + '</i></button>'
                                + '</div>';
                    }

                    $("#caja").html(caja);
                }

                $("#tbody").html(tablRow);
                $("#subtotal").text(formatter.format(sumSubtotal));
                $("#desc").text(formatter.format(descuento));
                $("#total").text(formatter.format(total));
                codigo.val("").focus();
            }
        });
        codigo.ForceNumericOnly();
}
}



function borrar_item(code_data, borrar) {
    var codigo = $("#code");
    var carga = $("#cargando");
    $.ajax({
        url: "ajax/procesador.venta.php",
        type: "POST",
        data: {codigo_desc: code_data, borrar: borrar},
        error: function (dato, error) {

            document.write(dato.responseText);
            alert("No se puede borrar. Error en el servidor" + dato + error);
            carga.html("");
        },
        success: function (dato) {
            var tablRow = '';
            var error = '';
            var warning = '';
            var success = '';
            var sumSubtotal = 0;
            var descuento = 0;
            var total = 0;
            var caja = '';
            const formatter = new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
                minimumFractionDigits: 2
            })


            if (dato.warning !== null && dato.warning !== undefined) {

                Materialize.toast(dato.warning, 1000, 'yellow darken-3');
            }


            if (dato.error !== null && dato.error !== undefined) {
                Materialize.toast(dato.error, 1000, 'red');
            }

            if (dato.success !== null && dato.success !== undefined) {
                Materialize.toast(dato.successs, 1000, 'card green darken-1 z-depth-4');
            }


            if (dato.cart.length !== undefined && dato.cart.length !== 0) {
                for (var i = 0; i < dato.cart.length; i++) {

                    tablRow += "<tr>" +
                            "<td>" + (i + 1) + "</td>"
                            + "<td>" + dato.cart[i].cve_medicamento + "</td>"
                            + "<td>" + dato.cart[i].nombre_generico + "</td>"
                            + "<td>" + dato.cart[i].nombre_comercial + "</td>"
                            + "<td>" + dato.cart[i].presentacion + "</td>"
                            + "<td>" + formatter.format(dato.cart[i].precio) + "</td>"
                            + "<td>" + dato.cart[i].unidad + "</td>"
                            + "<td>" + formatter.format((dato.cart[i].unidad * dato.cart[i].precio) - (dato.cart[i].unidad * dato.cart[i].precio) * (dato.cart[i].descuento / 100)) + "</td>"
                            + "<td><input id=\"descuento\" type=\"text\" onblur=\"listar_venta(event,'" + dato.cart[i].cve_medicamento + "', this.value)\" value='" + dato.cart[i].descuento + "' max=\"100\" min=\"0\"/></td>"
                            + "<td><button class=\"btn-floating red\" onclick=\"borrar_item(" + dato.cart[i].cve_medicamento + ",1)\"><i class=\"material-icons\">cancel</i></button></td>"
                            + "</tr>";
                    sumSubtotal += ((dato.cart[i].unidad * dato.cart[i].precio));
                    descuento += (dato.cart[i].unidad * dato.cart[i].precio) * (dato.cart[i].descuento / 100);
                    total += ((dato.cart[i].unidad * dato.cart[i].precio)) - (dato.cart[i].unidad * dato.cart[i].precio) * (dato.cart[i].descuento / 100);
                    ;
                    console.log(total);
                }
                console.log(dato.cart.length);
            }
            if (dato.cart.length === 0 || dato.cart.length === undefined || dato.cart.length === null) {
                console.log("holllllaa");
                caja += '<div class="input-field col s6 l6">'
                        + '<input type="text" id="money" placeholder="Efectivo.." disabled>'
                        + '</div>'
                        + '<div class="input-field col s3 l3">'
                        + '<button type="submit" class="btn" disabled><i class="material-icons" >'
                        + 'attach_money'
                        + '</i></button>'
                        + '</div>'
                        + '<div class="input-field col s3 l3 ">'
                        + '<button onclick="borrar_compra()" class="btn red" disabled><i class="material-icons" >'
                        + 'cancel'
                        + '</i></button>'
                        + '</div>';
            } else {
                caja += '<div class="input-field col s6 l6">'
                        + '<input type="text" id="money" placeholder="Efectivo..">'
                        + '</div>'
                        + '<div class="input-field col s3 l3">'
                        + '<button type="submit" class="btn"><i class="material-icons">'
                        + 'attach_money'
                        + '</i></button>'
                        + '</div>'
                        + '<div class="input-field col s3 l3 ">'
                        + '<button onclick="borrar_compra()" class="btn red"><i class="material-icons">'
                        + 'cancel'
                        + '</i></button>'
                        + '</div>';
            }
            $("#caja").html(caja);
            $("#tbody").html(tablRow);
            $("#subtotal").text(formatter.format(sumSubtotal));
            $("#desc").text(formatter.format(descuento));
            $("#total").text(formatter.format(total));
            codigo.val("").focus();
        }
    });
    codigo.ForceNumericOnly();
}


$("#cliente_paga").on('submit', function (e) {
    var money = $("#money");
    e.preventDefault();
    $.ajax({
        url: "ajax/procesador.pagar.php",
        dataType: 'json',
        type: "POST",
        data: {money: money.val()},
        error: function (dato) {
            document.write(dato.responseText);
        },
        success: function (dato) {
            console.log(dato);
            const formatter = new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'USD',
                minimumFractionDigits: 2
            });
            if (dato.warning !== null) {
                Materialize.toast(dato.warning, 6000, 'yellow darken-3');
            }

            if (dato.change !== null) {
                swal("Cambio", formatter.format(dato.change), 'success')
                        .then(() => {
                            window.location.href = "pedido?pe="+dato.pedido;
                        });
            }
        }
    });
});


function borrar_compra(){
     $.ajax({
        url: "ajax/procesador.borrar_compra.php",
        dataType: 'json',
        type: "POST",
        error: function (dato) {
            document.write(dato.responseText);
        },
        success: function (dato) {
            if(dato.warning == 'delete'){
                window.location.href = './';
            }
        }
    });
}

//Esta función evita las letras
jQuery.fn.ForceNumericOnly =
        function () {
            return this.each(function () {
                $(this).keydown(function (e) {
                    var key = e.charCode || e.keyCode || 0;
                    // allow backspace, tab, delete, arrows, numbers and keypad numbers ONLY
                    return (
                            key === 8 ||
                            key === 9 ||
                            key === 46 ||
                            (key >= 37 && key <= 40) ||
                            (key >= 48 && key <= 57) ||
                            (key >= 96 && key <= 105));
                });
            });
        };
//Preloader
document.addEventListener("DOMContentLoaded", function () {
    $('.preloader-background').delay(1600).fadeOut('slow');
    $('.preloader-wrapper').delay(1700).fadeOut();
})
        ;


        function PaginationOrder(page = null, limit = null) {
            $.ajax({
                url: '../caja/lista_pedido_ajax.php',
                data: {
                    page: page,
                    limit:limit
                },
                type: 'POST',
                dataType: 'json',
                success: (result) => {
                  var table = '';
                    if (result.pages != 0) {
                        
                        var right = ((result.pages == result.current_page + 1)) ? 'class="disabled"' : 'class="waves-effect"  onclick="PaginationOrder(' + ((result.current_page + 2)) + ','+result.limit+')"';
                        var left = ((result.current_page - 1) == -1) ? 'class="disabled"' : 'class="waves-effect"  onclick="PaginationOrder(' + ((result.current_page)) + ','+result.limit+')"';
          
                        var fast_back = (result.current_page <= 0) ? 'class="disabled"' : 'class="waves-effect"  onclick="PaginationOrder(' + ((result.current_page + 1 - result.pages)) + ','+result.limit+')"';
                        var fast_forward = ((result.pages == result.current_page + 1)) ? 'class="disabled"' : 'class="waves-effect"  onclick="PaginationOrder(' + ((result.pages)) + ','+result.limit+')"';
          
          
                        table = '<div class="card">';
                        table += '<div class="card-content">';
                        table += '<span class="card-title">Lista de pedidos <strong>'+result.rows+' pedido(s)</strong><span class="badge red white-text">Sin corte de Caja</span></span>';
                        table += '<div class="row">';
                        table += '<div class="col s12 l12">';
                        table += '<table class="responsive-table striped centered">';
                        table += '<thead>';
          
                        table += '<tr>';
                            for(let d = 0; d < result.header.length; d++ ){
                                table+= '<th>'+result.header[d]+'</th>';
                            }
                        table += '</tr>';
          
                        table += '</thead>';
          
                        '<tbody>';
          
                        for (var i = 0; i < result.datos.length; i++) {
          
                            table += '<tr>';
                            table += '<td>' + result.datos[i].id + '</td>';
                            table += '<td>' + result.datos[i].fecha + '</td>';
                            table += '<td>' + result.datos[i].n_productos + '</td>';
                            table += '<td>' + result.datos[i].usuario + '</td>';
                            table += '<td><a href="../venta/pedido?pe='+ result.datos[i].id + '" class="btn btn-floating"><i class="material-icons">remove_red_eye</i></a></td>';
                            table += '</tr>';
          
                        }
                        table += '</tbody>';
          
                        table += '</table>';
                        table += '<ul class="pagination">' +
                            '<li ' + fast_back + '><a href="javascript:void(0)" ><i class="material-icons">fast_rewind</i></a></li>' +
                            '<li ' + left + '><a href="javascript:void(0)"><i class="material-icons">chevron_left</i></a></li>';
                    
                        table+= paginate( result.current_page, result.pages, result.adjacent, result.limit, 'PaginationOrder');
          
                        table += '<li ' + right + '><a href="javascript:void(0)"><i class="material-icons">chevron_right</i></a></li>' +
                            '<li ' + fast_forward + '><a href="javascript:void(0)"><i class="material-icons">fast_forward</i></a></li>';
                       
                        table+='</ul>';
                        
                        table += '</div>';
                        
                        table += '</div>';
                        table += '<div class="row">';
                        table +='<div class="col l2 s2 offset-l10 offset-s10">';
            
                        table+='<input type="number" style="width:100%" value="'+result.limit+'" onchange="PaginationOrder(null, this.value)">';
                        table+='</div>';
                        table+= '</div>';
                        table += '</div>';
          
                        table += '</div>';
          
                    } else {
          
                        table += '<h4>No hay lista de pedidos actualmente</h4>';
                    }
          
                    lista_pedidos.html(table);
          
          
                },
                error: (errorThrown) => {
                    document.write(errorThrown.responseText);
                }
          
          
            });
          
          }
          
          
          
var showListMedication = $("#list-medication");
var inputSearch = $("#search_med");

//Cuando carga a la entrada del dato
$(document).ready(() => {
    PaginationMedicationList(null, null, inputSearch.val());
    inputSearch.focus();
});

//Cuando hace un un levantamiento de dato
inputSearch.on('keyup', (event) => {
    var code = event.keyCode || event.which;
    let search = inputSearch.val();
    if (code == 13) {
        PaginationMedicationList(null, null, search);
    }

    if (search.length == 0) {
        PaginationMedicationList(null, null, search)
    }
});

function PaginationMedicationList(page = null, limit = null, search = null) {
    console.log(search);
    $.ajax({
        url: 'medicamento_lista_ajax.php',
        data: {
            page: page,
            limit: limit,
            search: search
        },
        type: 'POST',
        dataType: 'json',
        beforeSend: function () {
            let loading = '';
            loading += '<div class="col s12 l12 center-align">';
            loading += '<div class="preloader-wrapper big active">';
            loading += '<div class="spinner-layer spinner-blue">';
            loading += '<div class="circle-clipper left">';
            loading += '<div class="circle"></div>';
            loading += '</div><div class="gap-patch">';
            loading += '<div class="circle"></div>';
            loading += '</div><div class="circle-clipper right">';
            loading += '<div class="circle"></div>';
            loading += '</div>';
            loading += '</div>';
            loading += '</div>';
            loading += '</div>';

            showListMedication.html(loading);
        },
        success: (result) => {
            console.log('log');
            console.log(result);
            var table = '';
            if (result.pages != 0) {

                var right = ((result.pages == result.current_page + 1)) ? 'class="disabled"' : 'class="waves-effect"  onclick="PaginationMedicationList(' + ((result.current_page + 2)) + ',' + result.limit + ',\'' + result.search + '\')"';
                var left = ((result.current_page - 1) == -1) ? 'class="disabled"' : 'class="waves-effect"  onclick="PaginationMedicationList(' + ((result.current_page)) + ',' + result.limit + ',\'' + result.search + '\')"';

                var fast_back = (result.current_page <= 0) ? 'class="disabled"' : 'class="waves-effect"  onclick="PaginationMedicationList(' + ((result.current_page + 1 - result.pages)) + ',' + result.limit + ',\'' + result.search + '\')"';
                var fast_forward = ((result.pages == result.current_page + 1)) ? 'class="disabled"' : 'class="waves-effect"  onclick="PaginationMedicationList(' + ((result.pages)) + ',' + result.limit + ',\'' + result.search + '\')"';


                table += '<div class="col s12 l12">';
                table += '<table class="responsive-table striped centered">';
                table += '<thead>';

                table += '<tr>';
                for (let d = 0; d < result.header.length; d++) {
                    table += '<th>' + result.header[d] + '</th>';
                }
                table += '</tr>';

                table += '</thead>';

                '<tbody>';

                for (var i = 0; i < result.datos.length; i++) {

                    table += '<tr>';
                    table += '<td>' + result.datos[i].cve_medicamento + '</td>';
                    table += '<td>' + result.datos[i].nombre_comercial + '</td>';
                    table += '<td>' + result.datos[i].nombre_generico + '</td>';
                    table += '<td>' + result.datos[i].presentacion + '</td>';
                    table += '<td>' + result.datos[i].categoria + '</td>';
                    table += '<td>' + result.datos[i].precio_adquisitivo + '</td>';
                    table += '<td>' + result.datos[i].precio_venta + '</td>';
                    table += '<td>' + result.datos[i].unidades_caja + '</td>';
                    table += '<td>' + i + '</td>';
                    table += '</tr>';

                }
                table += '</tbody>';

                table += '</table>';
                table += '<ul class="pagination">' +
                    '<li ' + fast_back + '><a href="javascript:void(0)" ><i class="material-icons">fast_rewind</i></a></li>' +
                    '<li ' + left + '><a href="javascript:void(0)"><i class="material-icons">chevron_left</i></a></li>';

                table += paginate(result.current_page, result.pages, result.adjacent, result.limit, 'PaginationMedicationList', "" + result.search + "");

                table += '<li ' + right + '><a href="javascript:void(0)"><i class="material-icons">chevron_right</i></a></li>' +
                    '<li ' + fast_forward + '><a href="javascript:void(0)"><i class="material-icons">fast_forward</i></a></li>';

                table += '</ul>';

                table += '</div>';
                table += '<div class="row">';
                table += '<div class="col l2 s2 offset-l10 offset-s10">';
                table += '<label for="row">Numero de Filas</label>';
                table += '<input id="row" type="number" style="width:100%" value="' + result.limit + '" onchange="PaginationMedicationList(null,this.value,  \'' + result.search + '\')">';
                table += '</div>';
                table += '</div>';



            } else {

                table += '<h4>No hay ningún resultado</h4>';
            }

            showListMedication.slideUp(10).fadeIn(200).html(table);


        },
        error: function (errorThrown) {
            document.write(errorThrown.responseText);
        }


    });

}